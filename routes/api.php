<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('users')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/forgot', [AuthController::class, 'forgot']);
    Route::post('/otp', [AuthController::class, 'getOtp']);
    Route::post('/reset', [AuthController::class, 'updatePass']);
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/registerstudent', [AuthController::class, 'registerStudent']);
        Route::post('/registeremployee', [AuthController::class, 'registerEmployee']);
        Route::post('/registerguardian', [AuthController::class, 'registerGuardian']);
    });
});
