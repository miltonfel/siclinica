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

Route::resource('/pacientes', 'App\Http\Controllers\PacientesController');
Route::resource('/convenios', 'App\Http\Controllers\ConveniosController');
Route::resource('/profissionais', 'App\Http\Controllers\ProfissionaisController');
Route::resource('/especialidades', 'App\Http\Controllers\EspecialidadesController');
Route::resource('/consultas', 'App\Http\Controllers\ConsultasController');
Route::resource('/receituarios', 'App\Http\Controllers\ReceituariosController');
Route::resource('/exames', 'App\Http\Controllers\ExamesController');
Route::resource('/tipos', 'App\Http\Controllers\TiposController');
Route::get('/buscarPacienteNome/{nome}', 'App\Http\Controllers\ConsultasController@buscarPacienteNome');
Route::get('/consultaPorPaciente/{id}', 'App\Http\Controllers\ConsultasController@consultaPorPaciente');
Route::post('/cadastrarConsulta', 'App\Http\Controllers\ConsultasController@cadastrarConsulta');
Route::get('/consultaPorData/{data}/{idProfissional}', 'App\Http\Controllers\ConsultasController@consultaPorData');
Route::post('/cancelarConsulta/{id}', 'App\Http\Controllers\ConsultasController@cancelarConsulta');
Route::post('/confirmarConsulta/{id}', 'App\Http\Controllers\ConsultasController@confirmarConsulta');
Route::get('/abrirConsulta/{id}', 'App\Http\Controllers\ConsultasController@abrirConsulta');
Route::get('/verificaLogin/{nome}/{email}/{foto}', 'App\Http\Controllers\SocialiteController@handleProviderCallback');
Route::get('/listarusuarios', 'App\Http\Controllers\ProfissionaisController@listarUsuarios');
Route::post('/alterartipousuarios/{id}/{tipo}', 'App\Http\Controllers\ProfissionaisController@alterarTipoUsuario');