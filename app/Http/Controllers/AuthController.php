<?php

namespace App\Http\Controllers;

use App\Mail\MailValidationUser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    
 
     /**
      * Inicio de sesión y creación de token
      */
      public function login(Request $request)
      {
          $request->validate([
              'email' => 'required|email',
              'password' => 'required|string',
              'remember_me' => 'boolean'
          ]);
  
          $credentials = request(['email', 'password']);
  
          if (!Auth::attempt($credentials)){            
             return response()->json([
                 'message' => 'No tiene autorización'
             ], 401);
          }
              
          $user = $request->user();
          Log::notice("El usuario {$user->id} ha iniciado sesión.");
 
         /* Descomentar si se necesita la verificación de usuario
         if(!$user->is_validated){
             return response()->json([
                 'message' => 'Su usuario no ha sido verificado!'
             ], 401);
         }*/

          $tokenResult = $user->createToken('Verifarma');
  
          $token = $tokenResult->token;
          if ($request->remember_me)
              $token->expires_at = Carbon::now()->addWeeks(1);
          $token->save();
  
          return response()->json([
              'access_token' => $tokenResult->accessToken,
              'token_type' => 'Bearer',
              'expires_at' => Carbon::parse($token->expires_at)->toDateTimeString()
          ],201);
      }

     //Guarda la validación del mail de contacto de la empresa en la BD
     public function validationUser(Request $request)
     {
         $validation_token = $request->input('token');
 
         $user = User::where([
             ['validation_token', '=', $validation_token]
         ])->first();
 
         try {
 
             if (!$user) {
                 throw new \Error('No existe un usuario con el token dado');
             } elseif ($user['is_validated'] == 1) {
                 throw new \Error('El mail del usuario ya estaba validado');
             }
 
             //UPDATE en la DB
             User::where('id', $user['id'])->update([
                 'is_validated' => 1,
             ]);

             Log::info("La validación del usuario ".$user['id']." fue exitosa");
 
             return response()->json([
                 'status' => 200,
                 'message' => 'Validación realizada con éxito'
             ],201);
         } catch (\Throwable $e) {
             $code = $e->getCode() ? $e->getCode() : 500;
             Log::warning("Se ha presentado el siguiente error: ".$e->getMessage());
             return response()->json([
                 'status' => $code,
                 'message' => $e->getMessage()
             ], $code);
         }
     }
 
     //Reenvía un mail al usuario para validar la cuenta
     public function sendMailRevalidationUser()
     {
         $user = Auth::user(); 
 
         Mail::to($user->email)->queue(new MailValidationUser($user));
 
         return response()->json(null, 201);
     }
 
     /**
      * Cierre de sesión (anular el token)
      */
     public function logout(Request $request)
     {
         $request->user()->token()->revoke();
 
         return response()->json([
             'message' => 'Successfully logged out'
         ]);
     }
}
