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
    Route::post('confirmPassword', 'AuthController@confirmPassword');
    Route::post('refresh', 'AuthController@refresh');

    //  Route::get('colaborador',[ColaboradorController::class,'buscar']);
});

// Grupo de rotas Administração
Route::group([
    'middleware' => 'api',
    'middleware' => 'adm',
    'prefix' => 'adm'
    ], function () {
        Route::get('/listAccess','AdmController@listAccess');
        Route::get('/listAccess/{id}','AdmController@show'); //Trás uma ou mais matriculas.
        Route::post('/usuario/create','AdmController@store');
        Route::put('/usuario/update','AdmController@update');
        Route::put('/usuario/updatePassword','AdmController@updatePassword');
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
    Route::get('/listCP', 'SituacaoController@listarCP');
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
    Route::post('/list', 'ColaboradorController@listar');
    Route::post('/listAllGestores', 'ColaboradorController@listAllGestores');
    Route::post('/listAllMonitores', 'ColaboradorController@listAllMonitores');
    Route::post('/buscarGestor', 'ColaboradorController@buscarGestor');
    Route::post('/buscarColab', 'ColaboradorController@buscarColab');
    Route::get('/{id}', 'ColaboradorController@buscar');
    Route::put('/up', 'ColaboradorController@update');
    Route::delete('/delete', 'ColaboradorController@delete');

    Route::post('/listAllCoord', 'ColaboradorController@listAllCoord');
    Route::post('/listAllSuperv', 'ColaboradorController@listAllSuperv');

});

// Grupo de rotas Desligamento
Route::group(['middleware' => 'api', 'prefix' => 'desligamento'], function () {
    Route::get('/tpDeslig', 'DesligamentoController@tpDeslig');
    Route::get('/locaisHom', 'DesligamentoController@locaisHom');
    Route::post('/buscarColab', 'DesligamentoController@buscarColab');
    Route::post('/create', 'DesligamentoController@create');
    Route::put('/up', 'DesligamentoController@update');
});

// Grupo de rotas Ocorrencias
Route::group(['middleware' => 'api', 'prefix' => 'ocorrencia'], function () {
    Route::post('/create', 'OcorrenciaController@create');
    Route::get('/list', 'OcorrenciaController@listar');
    //Route::get('/{id}', 'OcorrenciaController@buscarGestor');
    Route::put('/up', 'OcorrenciaController@update');
    Route::delete('/delete', 'OcorrenciaController@delete');
    Route::any('/listFiltro', 'OcorrenciaController@listarFiltros');
});

// Grupo de rotas sisfin
Route::group(['middleware' => 'api', 'prefix' => 'sisfin'], function () {
    Route::get('/{id}', 'SisfinController@search');
});


#######
