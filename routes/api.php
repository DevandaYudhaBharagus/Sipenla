<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\AttendanceController;
use App\Http\Controllers\API\AdmissionController;

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

Route::prefix('users')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot', [AuthController::class, 'forgot']);
    Route::post('/otp', [AuthController::class, 'getOtp']);
    Route::post('/reset', [AuthController::class, 'updatePass']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/registerstudent', [AuthController::class, 'registerStudent']);
        Route::post('/registeremployee', [AuthController::class, 'registerEmployee']);
        Route::post('/registerguardian', [AuthController::class, 'registerGuardian']);
        Route::get('/profile', [ProfileController::class, 'getProfile']);
        Route::get('/student', [ProfileController::class, 'getDataStudent']);
        Route::get('/guardian', [ProfileController::class, 'getGuardian']);
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('news')->group(function () {
        Route::get('/', [NewsController::class, 'getAllNews']);
        Route::post('/addnews', [NewsController::class, 'addNews']);
        Route::post('/{id}', [NewsController::class, 'updateNews']);
        Route::delete('/{id}', [NewsController::class, 'deleteNews']);
    });

    Route::prefix('attendances')->group(function () {
        Route::post('/addleave', [AttendanceController::class, 'addLeave']);
        Route::post('/addduty', [AttendanceController::class, 'addDuty']);
        Route::post('/checkin', [AttendanceController::class, 'checkIn']);
        Route::post('/checkout', [AttendanceController::class, 'checkOut']);
        Route::get('/gettype', [AttendanceController::class, 'getLeaveType']);
        Route::get('/history', [AttendanceController::class, 'historyAttendance']);
        Route::get('/historyall', [AttendanceController::class, 'historyAll']);
    });

    Route::prefix('admission')->group(function () {
        Route::post('/addemployee', [AdmissionController::class, 'addEmployee']);
        Route::post('/addstudent', [AdmissionController::class, 'addStudent']);
        Route::get('/getstudent', [AdmissionController::class, 'getStudent']);
        Route::get('/getemployee', [AdmissionController::class, 'getEmployee']);
        Route::post('/updatestudent/{id}', [AdmissionController::class, 'updateStudent']);
        Route::post('/updateemployee/{id}', [AdmissionController::class, 'updateEmployee']);
    });
});
