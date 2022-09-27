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
    return view('welcome');
});

// Reset Password
Route::get('otp/{token}', [ResetPasswordController::class, 'getPassword']);
Route::post('otp', [ResetPasswordController::class, 'updatePassword'])->name('resetpass');
