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
