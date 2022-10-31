<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPasswordController;

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
    return view('pages.home');
});
Route::get('/registrasi', function() {
    return view('pages.registrasi');
});
Route::get('/login', function() {
    return view('pages.login');
});
Route::get('dashboard', function(){
    return view('pages.dashboard');
});
Route::get('formulir', function(){
    return view('pages.siswa.formulir');
});
// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');