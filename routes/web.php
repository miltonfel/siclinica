<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/pacientes', function () {
    return view('pacientes');
});

Route::get('/profissionais', function () {
    return view('profissionais');
});

Route::get('/consulta_detalhe/{id?}', function ($id=null) {
    if (isset ($id)) return view('consulta_detalhe', ['id' => $id]);
    else return view('nova_consulta_detalhe');
});

Route::get('/historico_paciente/{id}', function ($id) {
    return view('historicoPaciente', ['id' => $id]);
});

Route::get('/consultasporpaciente', function () {
    if (isset(Auth::user()->id)) return view('consultasporpaciente');
    else echo "Você precisar estar logado como paciente para acessar essa página";
});

Route::get('/especialidades', function () {
    return view('especialidades');
});

Route::get('/convenios', function () {
    return view('convenios');
});

Route::get('/receituario', function () {
    return view('receituario');
});

Route::get('/exames', function () {
    return view('exames');
});

Route::get('/consultas', function () {
    return view('consultas');
});

Route::get('/tiposconsultas', function () {
    return view('tiposconsultas');
});

Route::get('/estabelecimento', function () {
    return view('estabelecimento');
});

Route::get('/tiposusuarios', function () {
    return view('tiposusuarios');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/googlelogin', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', 'App\Http\Controllers\SocialiteController@handleProviderCallback');

Route::prefix('/admin')->group(function() {
    Route::get('/login', 'App\Http\Controllers\Auth\AdminLoginController@index')->name('admin.login');
    Route::post('/login', 'App\Http\Controllers\Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'App\Http\Controllers\AdminController@index')->name('admin.dashboard');
});