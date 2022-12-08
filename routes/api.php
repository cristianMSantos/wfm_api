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
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    //  Route::get('colaborador',[ColaboradorController::class,'buscar']);
});

// Grupo de rotas Administração
Route::group([
    'middleware' => 'api',
    'middleware' => 'adm',
    'prefix' => 'adm'
    ], function () {
        Route::get('/usuario','AdmController@index');
        Route::get('/usuario/{id}','AdmController@show');
        Route::post('/usuario/create','AdmController@store');
        Route::put('/usuario/update','AdmController@update');
        Route::delete('/usuario/delete','AdmController@destroy');
});

// Grupo de rotas funcao
Route::group(['middleware' => 'api', 'prefix' => 'funcao'], function () {
    Route::post('/create', 'FuncaoController@create');
    Route::get('/', 'FuncaoController@buscar');
    Route::get('/list', 'FuncaoController@listar');
    Route::put('/up', 'FuncaoController@update');
    Route::delete('/delete', 'FuncaoController@delete');
});

// Grupo de rotas situacao
Route::group(['middleware' => 'api', 'prefix' => 'situacao'], function () {
    Route::post('/create', 'SituacaoController@create');
    Route::get('/', 'SituacaoController@buscar');
    Route::get('/list', 'SituacaoController@listar');
    Route::put('/up', 'SituacaoController@update');
    Route::delete('/delete', 'SituacaoController@delete');
});

// Grupo de rotas filial
Route::group(['middleware' => 'api', 'prefix' => 'filial'], function () {
    Route::post('/create', 'FilialController@create');
    Route::get('/', 'FilialController@buscar');
    Route::get('/list', 'FilialController@listar');
    Route::put('/up', 'FilialController@update');
    Route::delete('/delete', 'FilialController@delete');
});

// Grupo de rotas colaborador
Route::group(['middleware' => 'api', 'prefix' => 'colaborador'], function () {
    Route::post('/create', 'ColaboradorController@create');
    Route::get('/list', 'ColaboradorController@listar');
    Route::get('/{id}', 'ColaboradorController@buscarGestor');
    Route::put('/up', 'ColaboradorController@update');
    Route::delete('/delete', 'ColaboradorController@delete');
});

// Grupo de rotas Ocorrencias
Route::group(['middleware' => 'api', 'prefix' => 'ocorrencia'], function () {
    Route::post('/create', 'OcorrenciaController@create');
    Route::get('/list', 'OcorrenciaController@listar');
    Route::get('/{id}', 'OcorrenciaController@buscarGestor');
    Route::put('/up', 'OcorrenciaController@update');
    Route::delete('/delete', 'OcorrenciaController@delete');
});

// Grupo de rotas sisfin
Route::group(['middleware' => 'api', 'prefix' => 'sisfin'], function () {
    Route::get('/{id}', 'SisfinController@search');
});


#######
