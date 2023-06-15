<?php

use Illuminate\Http\Request;
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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Rota para pegar o usuário do sistema
Route::resource('/usuario', 'UsuarioController');

Route::get('/', 'TesteController@index');

Route::group([
    'prefix' => 'auth'
], function ($router) {

    Route::post('login', 'AuthController@login')->name('login');
    Route::post('logout', 'AuthController@logout');
    Route::post('me', 'AuthController@me');
    Route::post('reset', 'AuthController@reset');
    Route::post('resetOwnPassword', 'AuthController@getOwnPassword');
    Route::post('confirmPassword', 'AuthController@confirmPassword');
    Route::post('refresh', 'AuthController@refresh');


    Route::post('checkMatricula', 'AuthController@checkMatricula');

    //  Route::get('colaborador',[ColaboradorController::class,'buscar']);
});



#######
