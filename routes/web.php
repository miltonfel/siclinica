<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

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
    if (isset ($id)) return view('consulta_detalhe', ['id' => '$id']);
    else return view('nova_consulta_detalhe');
});

Route::get('/especialidades', function () {
    return view('especialidades');
});

Route::get('/convenios', function () {
    return view('convenios');
});

Route::get('/consultas', function () {
    return view('consultas');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/googlelogin', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/auth/callback', function () {
    $user = Socialite::driver('google')->user();

    //echo "<img src= { $user->getAvatar()}><br>";
    echo "<h1> Olá {$user->getName()} </h1>";
    echo "<img src={$user->getAvatar()}>";

    // $user->token
});
