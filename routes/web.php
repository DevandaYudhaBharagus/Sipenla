<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MasterStudentController;
use App\Http\Controllers\MasterTeacherController;
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
Route::get('/master-pegawai', function(){
    return view('pages.master.master-pegawai');
});
Route::get('/master-siswa', function(){
    return view('pages.master.master-siswa');
});
Route::get('/master-kelas', function(){
    return view('pages.master.master-kelas');
});
Route::get('/master-ekstra', function(){
    return view('pages.master.master-extra');
});
Route::get('/master-fasilitas', function(){
    return view('pages.master.master-fasilitas');
});
Route::get('/master-jadwal', function(){
    return view('pages.master.master-jadwal');
});
Route::get('/master-mapel', function(){
    return view('pages.master.master-mapel');
});
Route::get('/master-shift', function(){
    return view('pages.master.master-shift');
});
Route::get('/master-kantin', function(){
    return view('pages.master.master-kantin');
});
Route::get('/master-koperasi', function(){
    return view('pages.master.master-koperasi');
});
Route::get('/master-spp', function(){
    return view('pages.master.master-keuangan-spp');
});
Route::get('/master-tabungan', function(){
    return view('pages.master.master-keuangan-tabungan');
});
Route::get('/master-denda', function(){
    return view('pages.master.master-keuangan-denda');
});
Route::get('/master-isi-saldo', function(){
    return view('pages.master.master-keuangan-isi-saldo');
});
Route::get('/master-tarik-saldo', function(){
    return view('pages.master.master-keuangan-tarik-saldo');
});

Auth::routes();

//Forgot Pass
Route::get('/lupa-sandi', [ForgotPassController::class, 'index']);
Route::get('/otp', [ForgotPassController::class, 'getOtp']);
Route::post('/postotp', [ForgotPassController::class, 'postOtp'])->name('postotp');
Route::post('/forgotpass', [ForgotPassController::class, 'postEmail'])->name('forgotpass');
Route::post('/resetpass', [ForgotPassController::class, 'updatePass'])->name('resetpass');
Route::get('/', [LandingPageController::class, 'getnews']);
Route::get('/detail-news/{id}', [NewsController::class, 'getNewsById']);

//Logout
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function () {
    //Route Dashboard
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('dashboard');
        Route::post('/formstudent', [HomeController::class, 'addStudent'])->name('formstudent');
        Route::post('/formemployee', [HomeController::class, 'addEmployee'])->name('formemployee');
        Route::get('/registrasi', [RegisterController::class, 'index']);
        Route::post('/registrasiuser', [RegisterController::class, 'addUser'])->name('formregister');
        Route::get('/profil', [ProfleController::class, 'index']);
    });

    //Route News
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index']);
        Route::get('/create-news', [NewsController::class, 'show']);
        Route::post('/create-news', [NewsController::class, 'store'])->name('createnews');
        Route::get('/delete-news/{id}', [NewsController::class, 'delete'])->name('deletenews');
    });

    //Route Teccher
    Route::prefix('teacher')->group(function () {
        Route::get('/', [MasterTeacherController::class, 'index']);
        Route::get('/delete-teacher/{id}', [MasterTeacherController::class, 'delete'])->name('deleteteacher');
    });

    //Route Student
    Route::prefix('student')->group(function () {
        Route::get('/', [MasterStudentController::class, 'index']);
        Route::get('/delete-student/{id}', [MasterStudentController::class, 'delete'])->name('deletestudent');
    });
});
