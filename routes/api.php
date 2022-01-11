<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;

//Login
Route::post('/login', [LoginController::class, 'onLogin']);

//Password 
Route::post('/EmailVerification', [PasswordController::class, 'EmailVerification']);
Route::post('/GetOTPExpiration', [PasswordController::class, 'GetOTPExpiration']);
Route::post('/OTPVerification', [PasswordController::class, 'OTPVerification']);
Route::post('/ResetPassword', [PasswordController::class, 'ResetPassword']);
Route::post('/ChangePassword', [PasswordController::class, 'ChangePassword']);

//User Profile

Route::get('/GetUserProfile/{id}', [ProfileController::class, 'GetUserProfile']);
Route::post('/UpdateProfile', [ProfileController::class, 'UpdateProfile']);









Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::fallback(function () {
    abort(404);
});
