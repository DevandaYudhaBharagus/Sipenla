<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ShiftController;
use App\Http\Controllers\ProfleController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\DataUserController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ForgotPassController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\API\AdmissionController;
use App\Http\Controllers\MasterStudentController;
use App\Http\Controllers\MasterTeacherController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\EkstrakurikulerController;
use App\Http\Controllers\LessonSchedulesController;
use App\Http\Controllers\AdmissionController as ControllersAdmissionController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\RaportController;

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

// Fokus Yang Dikerjain
Route::get('/monitoring', function(){
    return view('pages.monitoring.monitoring');
});
Route::get('/absensi-siswa', function(){
    return view('pages.tabel-data.absensi-siswa');
});
Route::get('/raport', function(){
    return view('pages.raport.raport-siswa');
});
Route::get('/riwayat-raport', function(){
    return view('pages.raport.riwayat-raport');
});
Route::get('/detail-raport-kelas', function(){
    return view('pages.raport.detail-raport-kelas');
});
Route::get('/walkel-detail-raport', function(){
    return view('pages.raport.riwayat-walkel-raport');
});


// keuangan
Route::get('/keuangan', function(){
    return view('pages.keuangan.dash-keuangan');
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
        Route::get('/profil', [ProfleController::class, 'index']);
        Route::get('/registrasi', [RegisterController::class, 'index']);
        Route::get('/registrasi/employee', [RegisterController::class, 'registeremployee'])->name('registeremployee');
        Route::get('/registrasi/student', [RegisterController::class, 'registerstudent'])->name('registerstudent');
        Route::get('/registrasi/walimurid', [RegisterController::class, 'registerwalimuird'])->name('registerwalimuird');
        Route::post('/registrasiuser', [RegisterController::class, 'addUser'])->name('formregister');
        Route::post('/registerguardian', [RegisterController::class, 'addGuardian'])->name('addGuardian');
    });

    //Route News
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'index'])->name('getNews');
        Route::get('/create-news', [NewsController::class, 'show']);
        Route::post('/create-news', [NewsController::class, 'store'])->name('createnews');
        Route::delete('/delete-news/{id}', [NewsController::class, 'delete']);
        Route::get('/update-news/{id}', [NewsController::class, 'updatenews'])->name('updatenews');
        Route::post('/fungsi-update-news/{id}', [NewsController::class, 'fungsiupdate'])->name('fungsiupdate');
    });

    //Route Pegawai
    Route::prefix('employee')->group(function () {
        Route::get('/', [PegawaiController::class, 'index']);
        Route::delete('/{id}', [PegawaiController::class, 'delete']);
        Route::get('/photo/{id}', [PegawaiController::class, 'deletePhoto']);
        Route::post('/photo/{id}', [PegawaiController::class, 'updatePhoto']);
        Route::get('/{id}/edit', [PegawaiController::class, 'edit']);
        Route::post('/{id}', [PegawaiController::class, 'update']);
    });

    //Route Teacher
    Route::prefix('teacher')->group(function () {
        Route::get('/', [MasterTeacherController::class, 'index']);
        Route::delete('/delete-teacher/{id}', [MasterTeacherController::class, 'delete']);
    });

    //Route Student
    Route::prefix('student')->group(function () {
        Route::get('/', [MasterStudentController::class, 'index']);
        Route::delete('/delete-student/{id}', [MasterStudentController::class, 'delete']);
        Route::get('/{id}/edit', [MasterStudentController::class, 'edit']);
        Route::post('/{id}', [MasterStudentController::class, 'update']);
    });

    //Route Shift
    Route::prefix('workshift')->group(function () {
        Route::get('/', [ShiftController::class, 'index']);
        Route::post('/addshift', [ShiftController::class, 'store']);
        Route::get('/{id}/edit', [ShiftController::class, 'edit']);
        Route::post('/{id}', [ShiftController::class, 'update']);
        Route::delete('/delete-shift/{id}', [ShiftController::class, 'delete']);
    });

    //Route Subject
    Route::prefix('subject')->group(function () {
        Route::get('/', [SubjectController::class, 'index']);
        Route::post('/addsubject', [SubjectController::class, 'store']);
        Route::get('/{id}/edit', [SubjectController::class, 'edit']);
        Route::post('/{id}', [SubjectController::class, 'update']);
        Route::delete('/delete-subject/{id}', [SubjectController::class, 'delete']);
    });

    //Route Ekstrakurikuler
    Route::prefix('ekstrakurikuler')->group(function (){
        Route::get('/', [EkstrakurikulerController::class, 'index']);
        Route::post('/addekstra', [EkstrakurikulerController::class, 'store']);
        Route::get('/{id}/edit', [EkstrakurikulerController::class, 'edit']);
        Route::post('/{id}', [EkstrakurikulerController::class, 'update']);
        Route::delete('/delete-ekstra/{id}', [EkstrakurikulerController::class, 'delete']);
    });

    //Route Facility
    Route::prefix('facility')->group(function (){
        Route::get('/', [FacilityController::class, 'index']);
        Route::post('/addfacility', [FacilityController::class, 'store']);
        Route::get('/{id}/edit', [FacilityController::class, 'edit']);
        Route::post('/{id}', [FacilityController::class, 'update']);
        Route::delete('/delete-facility/{id}', [FacilityController::class, 'delete']);
    });

    //Route Grade
    Route::prefix('grade')->group(function (){
        Route::get('/', [GradeController::class, 'index']);
        Route::get('/class', [GradeController::class, 'viewKelasSiswa']);
        Route::post('/addclass', [GradeController::class, 'gradeStore']);
        Route::post('/addgrade', [GradeController::class, 'store']);
        Route::get('/{id}/edit', [GradeController::class, 'edit']);
        Route::get('/class/{grade}', [GradeController::class, 'getDetail']);
        Route::post('/{id}', [GradeController::class, 'update']);
        Route::delete('/delete-grade/{id}', [GradeController::class, 'delete']);
        Route::delete('/delete-class/{id}', [GradeController::class, 'deleteGrade']);
        Route::delete('/delete-student/{id}', [GradeController::class, 'deleteStudent']);
    });

    //Route Schedules
    Route::prefix('schedules')->group(function (){
        Route::get('/', [LessonSchedulesController::class, 'index']);
        Route::post('/addschedule', [LessonSchedulesController::class, 'store']);
        Route::get('/{id}/edit', [LessonSchedulesController::class, 'edit']);
        Route::post('/{id}', [LessonSchedulesController::class, 'update']);
        Route::delete('/delete-schedules/{id}', [LessonSchedulesController::class, 'delete']);
    });

    //Route Extra Schedules
    Route::prefix('extra-schedules')->group(function (){
        Route::get('/', [LessonSchedulesController::class, 'schedulesEkstrakurikuler']);
        Route::post('/addscheduleextra', [LessonSchedulesController::class, 'storeExtra']);
        Route::post('/{id}', [LessonSchedulesController::class, 'updateExtra']);
        Route::get('/{id}/edit-ekstrakurikuler', [LessonSchedulesController::class, 'editSchedulesEkstrakurikuler']);
        Route::delete('/del-ekstrakurikuler/{id}', [LessonSchedulesController::class, 'delSchedulesEkstrakurikuler']);
    });

    //Route Absensi
    Route::prefix('absensi')->group(function (){
        Route::get('/', [AttendanceController::class, 'index']);
        Route::get('/landpage', [AttendanceController::class, 'absensi']);
        Route::post('/cekin', [AttendanceController::class, 'checkin']);
        Route::post('/cekout', [AttendanceController::class, 'checkOut']);
        Route::post('/cuti', [AttendanceController::class, 'addLeave']);
        Route::post('/duty', [AttendanceController::class, 'addDuty']);
        Route::get('/page-checkout', [AttendanceController::class, 'absensiKeluar']);
    });

    //Route Data Siswa dan Pegawai
    Route::prefix('admission')->group(function (){
        Route::get('/', [ControllersAdmissionController::class, 'index']);
        Route::get('/datapegawai', [ControllersAdmissionController::class, 'getDataPegawai']);
        Route::get('/datasiswa', [ControllersAdmissionController::class, 'getDataSiswa']);

    });

    //Route Formulir
    Route::prefix('datauser')->group(function (){
        Route::get('/student', [DataUserController::class, 'getDataStudent']);
        Route::get('/employee', [DataUserController::class, 'getDataEmployee']);
        Route::get('/folmulirsiswa/{id}', [DataUserController::class, 'getFolmulirsiswa']);
        Route::get('/folmulirpegawai/{id}', [DataUserController::class, 'getFolmulirpegawai']);
        Route::get('/absensipegawai/{id}', [DataUserController::class, 'getAbsensiPegawai']);
    });

    //Route Penilaian
    Route::prefix('penilaian')->group(function (){
        Route::post('/store', [PenilaianController::class, 'penilaianStore'])->name('penilaianStore');
        Route::get('/home', [PenilaianController::class, 'index']);
        Route::get('/riwayat', [PenilaianController::class, 'riwayatPenilaian']);
        Route::get('/riwayat/penilaian', [PenilaianController::class, 'getRiwayat'])->name('riwayatPenilaian');
        Route::get('/', [PenilaianController::class, 'getFilteringPenilaian']);
        Route::get('/inputnilai', [PenilaianController::class, 'PenilaianSiswa'])->name('getStudentForPenilaian');
        Route::get('/{id}/edit', [PenilaianController::class, 'edit']);
        Route::post('/{id}', [PenilaianController::class, 'update']);
    });

    //Route Jadwal Mapel Guru
    Route::prefix('mapel-guru')->group(function (){
        Route::get('/', [LessonSchedulesController::class, 'getScheduleByUser']);
    });

    //Route Tabel Siswa
    Route::prefix('table')->group(function (){
        Route::get('/siswa', [DataUserController::class, 'getSiswa']);
        Route::get('/pegawai', [DataUserController::class, 'getPegawai']);
    });

    // Jadwal Mapel Siswa
    Route::prefix('mapel-siswa')->group(function (){
        Route::get('/', [LessonSchedulesController::class, 'getScheduleByStudent']);
    });

    //Route Blank Space Master
    Route::get('/master', function(){
        return view('pages.master.home-master');
    });

    //Route Jadwal
    Route::get('jadwal', function(){
        // return view('pages.jadwal.jadwal');
        Route::get('/', [JadwalController::class, 'index']);
        Route::get('/jadwal-kerja', [JadwalController::class, 'jadwalkerja'])->name('jadwalkerja');
    });

    // Raport
    Route::prefix('raport')->group(function (){
        Route::get('/', [RaportController::class, 'index']);
    });
});
