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
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\SubjectController;

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

    //Route Pegawai
    Route::prefix('employee')->group(function () {
        Route::get('/', [PegawaiController::class, 'index']);
        Route::get('/{id}', [PegawaiController::class, 'delete']);
        Route::get('/photo/{id}', [PegawaiController::class, 'deletePhoto']);
        Route::post('/photo/{id}', [PegawaiController::class, 'updatePhoto']);
    });

    //Route Teacher
    Route::prefix('teacher')->group(function () {
        Route::get('/', [MasterTeacherController::class, 'index']);
        Route::get('/delete-teacher/{id}', [MasterTeacherController::class, 'delete'])->name('deleteteacher');
    });

    //Route Student
    Route::prefix('student')->group(function () {
        Route::get('/', [MasterStudentController::class, 'index']);
        Route::get('/delete-student/{id}', [MasterStudentController::class, 'delete'])->name('deletestudent');
        Route::get('/{id}/edit', [MasterStudentController::class, 'edit']);
        Route::post('/{id}', [MasterStudentController::class, 'update']);
    });

    //Route Shift
    Route::prefix('workshift')->group(function () {
        Route::get('/', [ShiftController::class, 'index']);
        Route::post('/addShift', [ShiftController::class, 'store'])->name('addshift');
        Route::get('/delete-shift/{id}', [ShiftController::class, 'delete'])->name('deletehift');
    });

    //Route Subject
    Route::prefix('subject')->group(function () {
        Route::get('/', [SubjectController::class, 'index']);
        Route::post('/addSubject', [SubjectController::class, 'store'])->name('addsubject');
        Route::get('/delete-subject/{id}', [SubjectController::class, 'delete'])->name('deletesubject');
    });
});
