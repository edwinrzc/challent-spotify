<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SpotifyController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'prefix' => 'v1',
], function () {

    Route::group([
        'prefix' => 'auth'
    ], function () {
        Route::post('login', [AuthController::class, 'login']);
        Route::post('register', [RegisterController::class, 'register']);
    
        Route::group([
          'middleware' => 'auth:api'
        ], function() {
            Route::get('logout', [AuthController::class, 'logout']);
        });
    
    });

    Route::get('/albums', [SpotifyController::class, 'albums'])->parameterNames('q');

});



