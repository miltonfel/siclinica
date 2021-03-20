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
