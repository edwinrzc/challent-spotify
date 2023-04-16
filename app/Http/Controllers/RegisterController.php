<?php

namespace App\Http\Controllers;

use App\Mail\MailValidationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    protected $validation_rules = [
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
    ];

    public function register(Request $request)
    {
        
        $validator = Validator::make($request->all(), $this->validation_rules, [
            'email.unique' => "Esta dirección de correo electrónico se encuentra en uso",
            'password' => "La contraseña debe tener 8 caracteres o más",
            'password_confirmation' => "La contraseñas no coinciden",
            'name' => "El atributo Nombre es requerido",
        ]);

        
       
        try {

            
            
            DB::beginTransaction();

            $data = $validator->validate();
            //Descomentar, si desea implementar la validación de usuario
            //$user_validation_token = Str::random(50);

            $user = User::create([
                'name' => $data['name'], 
                'email' => $data['email'], //bcrypt($datos['password'])
                'password' => Hash::make($data['password']), 
                //'validation_token' => $user_validation_token, 
            ]);

            //Mail::to($user->email)->queue(new MailValidationUser($user->toArray()));
            Log::notice("El usuario {$user->id} se ha registrado de manera exitosa.");

            DB::commit();

            return response()->json([
                'message'=>'El usuario fue creado con éxito!'
            ], 201);
        }
        catch (\Throwable $error) {
            DB::rollBack();
            $code = $error->getCode() ? $error->getCode() : 500;
            Log::warning("Se ha presentado el siguiente error: ".$error->getMessage());
            return response()->json([
                'status' => $code,
                'message' => $error->getMessage()
            ], $code);
        }
    }
}
