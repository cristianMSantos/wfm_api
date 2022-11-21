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

Route::resource('/eleven_endpoint', 'ElevenController');

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

// Grupo de rotas Cargo
Route::group(['middleware' => 'api', 'middleware' => 'allPerfils', 'prefix' => 'cargo'], function () {
    Route::post('/create', 'CargoController@create');
    Route::get('/', 'CargoController@buscar');
    Route::get('/list', 'CargoController@listar');
    Route::put('/up', 'CargoController@update');
    Route::delete('/delete', 'CargoController@delete');
});

//Grupo de rotas Cargo - Gestor
Route::group(['middleware' => 'api', 'prefix' => 'cargo'], function () {
    Route::get('/', 'CargoController@buscar');
    Route::get('/list', 'CargoController@listar');
});

Route::group(['middleware' => 'api', 'middleware' => 'gestor', 'prefix' => 'cargo'], function () {
    Route::post('/create', 'CargoController@create');
    Route::put('/up', 'CargoController@update');
    Route::delete('/delete', 'CargoController@delete');
});

// Grupo de rotas Centralizadora
Route::group(['middleware' => 'api', 'prefix' => 'Centralizadora'], function () {
    Route::post('/create', 'CentralizadoraController@create');
    Route::get('/', 'CentralizadoraController@buscar');
    Route::get('/list', 'CentralizadoraController@listar');
    Route::put('/up', 'CentralizadoraController@update');
    Route::delete('/delete', 'CentralizadoraController@delete');
});
// Grupo de rotas cid
Route::group(['middleware' => 'api', 'prefix' => 'cid'], function () {
    Route::post('/create', 'CidController@create');
    Route::get('/', 'CidController@buscar');
    Route::get('/list', 'CidController@listar');
    Route::put('/up', 'CidController@update');
    Route::delete('/delete', 'CidController@delete');
});

// Grupo de rotas colaborador
Route::group(['middleware' => 'api', 'middleware' => 'allPerfils', 'prefix' => 'colaborador'], function () {
    Route::post('/create', 'ColaboradorController@create');
    Route::get('/', 'ColaboradorController@buscar');
    Route::get('/list', 'ColaboradorController@listar');
    Route::put('/up', 'ColaboradorController@update');
    Route::delete('/delete', 'ColaboradorController@delete');
});

// Grupo de rotas colaborador - Gestor
Route::group(['middleware' => 'api', 'middleware' => 'gestor', 'prefix' => 'gestor'], function () {
    Route::post('/create', 'ColaboradorController@create');
    Route::get('/', 'ColaboradorController@buscar');
    Route::get('/list', 'ColaboradorController@listar');
    Route::put('/up', 'ColaboradorController@update');
    Route::delete('/delete', 'ColaboradorController@delete');
});

// Grupo de rotas ColaboradorEmpresa
Route::group(['middleware' => 'api', 'prefix' => 'colaboradorempresa'], function () {
    Route::post('/create', 'ColaboradorEmpresaController@create');
    Route::get('/', 'ColaboradorEmpresaController@buscar');
    Route::get('/list', 'ColaboradorEmpresaController@listar');
    Route::put('/up', 'ColaboradorEmpresaController@update');
    Route::delete('/delete', 'ColaboradorEmpresaController@delete');
});

// Grupo de rotas ColaboradorMatricula
Route::group(['middleware' => 'api', 'prefix' => 'colaboradormatricula'], function () {
    Route::post('/create', 'ColaboradorMatriculaController@create');
    Route::get('/', 'ColaboradorMatriculaController@buscar');
    Route::get('/list', 'ColaboradorMatriculaController@listar');
    Route::put('/up', 'ColaboradorMatriculaController@update');
    Route::delete('/delete', 'ColaboradorMatriculaController@delete');
});

// Grupo de rotas ColaboradorPerfil
Route::group(['middleware' => 'api', 'prefix' => 'colaboradorPerfil'], function () {
    Route::post('/create', 'ColaboradorPerfilController@create');
    Route::get('/', 'ColaboradorPerfilController@buscar');
    Route::get('/list', 'ColaboradorPerfilController@listar');
    Route::put('/up', 'ColaboradorPerfilController@update');
    Route::delete('/delete', 'ColaboradorPerfilController@delete');
});
// Grupo de rotas Contrato
Route::group(['middleware' => 'api', 'middleware' => 'allPerfils', 'prefix' => 'contrato'], function () {
    Route::post('/create', 'ContratoController@create');
    Route::get('/', 'ContratoController@buscar');
    Route::get('/list', 'ContratoController@listar');
    Route::put('/up', 'ContratoController@update');
    Route::delete('/delete', 'ContratoController@delete');
});

// Grupo de rotas Evento
Route::group(['middleware' => 'api', 'prefix' => 'evento'], function () {
    Route::post('/create', 'EventoController@create');
    Route::get('/', 'EventoController@buscar');
    Route::get('/list', 'EventoController@listar');
    Route::put('/up', 'EventoController@update');
    Route::delete('/delete', 'EventoController@delete');
});
// Grupo de rotas GestorSSAT
Route::group(['middleware' => 'api', 'prefix' => 'gestorSSAT'], function () {
    Route::post('/create', 'GestorSSATController@create');
    Route::get('/', 'GestorSSATController@buscar');
    Route::get('/list', 'GestorSSATController@listar');
    Route::put('/up', 'GestorSSATController@update');
    Route::delete('/delete', 'GestorSSATController@delete');
});
// Grupo de rotas HistoricoEmailSSAT
Route::group(['middleware' => 'api', 'prefix' => 'historicoEmailSSAT'], function () {
    Route::post('/create', 'HistoricoEmailSSATController@create');
    Route::get('/', 'HistoricoEmailSSATController@buscar');
    Route::get('/list', 'HistoricoEmailSSATController@listar');
    Route::put('/up', 'HistoricoEmailSSATController@update');
    Route::delete('/delete', 'HistoricoEmailSSATController@delete');
});
// Grupo de rotas Municipio
Route::group(['middleware' => 'api', 'prefix' => 'municipio'], function () {
    Route::post('/create', 'MunicipioController@create');
    Route::get('/', 'MunicipioController@buscar');
    Route::get('/list', 'MunicipioController@listar');
    Route::put('/up', 'MunicipioController@update');
    Route::delete('/delete', 'MunicipioController@delete');
});
// Grupo de rotas Perfil
Route::group(['middleware' => 'api', 'prefix' => 'perfil'], function () {
    Route::post('/create', 'PerfilController@create');
    Route::get('/', 'PerfilController@buscar');
    Route::get('/list', 'PerfilController@listar');
    Route::put('/up', 'PerfilController@update');
    Route::delete('/delete', 'PerfilController@delete');
});

// Grupo de rotas RequisicaoSSAT
Route::group(['middleware' => 'api', 'prefix' => 'requisicaoSSAT'], function () {
    Route::post('/create', 'RequisicaoSSATController@create');
    Route::get('/', 'RequisicaoSSATController@buscar');
    Route::get('/list', 'RequisicaoSSATController@listar');
    Route::put('/up', 'RequisicaoSSATController@update');
    Route::delete('/delete', 'RequisicaoSSATController@delete');
});

// Grupo de rotas Setor
Route::group(['middleware' => 'api', 'prefix' => 'setor'], function () {
    Route::post('/create', 'SetorController@create');
    Route::get('/', 'SetorController@buscar');
    Route::get('/list', 'SetorController@listar');
    Route::put('/up', 'SetorController@update');
    Route::delete('/delete', 'SetorController@delete');
});
// Grupo de rotas SistemaSIADM
Route::group(['middleware' => 'api', 'prefix' => 'sistemaSIADM'], function () {
    Route::post('/create', 'SistemaSIADMController@create');
    Route::get('/', 'SistemaSIADMController@buscar');
    Route::get('/list', 'SistemaSIADMController@listar');
    Route::put('/up', 'SistemaSIADMController@update');
    Route::delete('/delete', 'SistemaSIADMController@delete');
});

// Grupo de rotas SituacaoSIADM
Route::group(['middleware' => 'api', 'prefix' => 'situacaoSIADM'], function () {
    Route::post('/create', 'SituacaoSIADMController@create');
    Route::get('/', 'SituacaoSIADMController@buscar');
    Route::get('/list', 'SituacaoSIADMController@listar');
    Route::put('/up', 'SituacaoSIADMController@update');
    Route::delete('/delete', 'SituacaoSIADMController@delete');
});

// Grupo de rotas Situacao
Route::group(['middleware' => 'api', 'middleware' => 'allPerfils', 'prefix' => 'situacao'], function () {
    Route::post('/create', 'SituacaoController@create');
    Route::get('/', 'SituacaoController@buscar');
    Route::get('/list', 'SituacaoController@listar');
    Route::put('/up', 'SituacaoController@update');
    Route::delete('/delete', 'SituacaoController@delete');
});
// Grupo de rotas SolicitacaoSIADM
Route::group(['middleware' => 'api', 'prefix' => 'solicitacaoSIADM'], function () {
    Route::post('/create', 'SolicitacaoSIADMController@create');
    Route::get('/', 'SolicitacaoSIADMController@buscar');
    Route::get('/list', 'SolicitacaoSIADMController@listar');
    Route::put('/up', 'SolicitacaoSIADMController@update');
    Route::delete('/delete', 'SolicitacaoSIADMController@delete');
});

// Grupo de rotas teste
Route::group(['middleware' => 'api', 'prefix' => 'teste'], function () {
    Route::get('/', 'TesteController@index');
});

// Grupo de rotas TipoEvento
Route::group(['middleware' => 'api', 'prefix' => 'tipoEvento'], function () {
    Route::post('/create', 'TipoEventoController@create');
    Route::get('/', 'TipoEventoController@buscar');
    Route::get('/list', 'TipoEventoController@listar');
    Route::put('/up', 'TipoEventoController@update');
    Route::delete('/delete', 'TipoEventoController@delete');
});

// Grupo de rotas UF
Route::group(['middleware' => 'api', 'middleware' => 'allPerfils', 'prefix' => 'Uf'], function () {
    Route::post('/create', 'UfController@create');
    Route::get('/', 'UfController@buscar');
    Route::get('/list', 'UfController@listar');
    Route::put('/up', 'UfController@update');
    Route::delete('/delete', 'UfController@delete');
});


#######
