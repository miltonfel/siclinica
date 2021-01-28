<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/especialidades', function () {
    return view('especialidades');
});

Route::get('/convenios', function () {
    return view('convenios');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
