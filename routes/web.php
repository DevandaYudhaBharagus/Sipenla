<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
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
    return view('pages.home');
});
Route::get('/registrasi', function() {
    return view('pages.registrasi');
});
// Route::get('/login', function() {
//     return view('pages.login');
// });
// Route::get('/dash', function() {
//     return view('pages.dashboard.dashboard');
// });
Route::get('/lupa-sandi', function() {
    return view('pages.auth.lupa-sandi');
});
Route::get('/otp', function() {
    return view('pages.auth.otp');
});
Route::get('/new-password', function() {
    return view('pages.auth.new-pass');
});
Route::get('/news', function() {
    return view('pages.news.news');
});
Route::get('/create-news', function() {
    return view('pages.news.create-news');
});
Route::get('/detail-news', function() {
    return view('pages.news.detail-news');
});
Route::get('/profil', function() {
    return view('pages.dashboard.profil');
});
Route::get('/form-siswa', function() {
    return view('pages.dashboard.formulir');
});
Route::get('/form-pegawai', function() {
    return view('pages.dashboard.formulir-pegawai');
});
Route::get('/master-role', function(){
    return view('pages.master.master-role');
});
Route::get('/master-perpus', function(){
    return view('pages.master.master-perpustakaan');
});
Route::get('/master-kehilangan', function(){
    return view('pages.master.master-buku-hilang');
});
Route::get('/master-sumbangan', function(){
    return view('pages.master.master-buku-sumbangan');
});
Route::get('/master-guru', function(){
    return view('pages.master.master-guru');
});
// Route::get('formulir', function(){
//     return view('pages.siswa.formulir');
// });

Auth::routes();

Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::post('/formstudent', [HomeController::class, 'addStudent'])->name('formstudent');
    });
});
