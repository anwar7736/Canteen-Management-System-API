<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DailyMealItemController;
use App\Http\Controllers\NotificationController;

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



//DayWiseMealItem

Route::get('/GetDailyMealItem', [DailyMealItemController::class, 'GetDayWiseMealItem']);

//Notification

Route::post('/SendMessage', [NotificationController::class, 'InsertNotification']);
Route::get('/GetSelfCreatedNotification/{user_id}', [NotificationController::class, 'GetSelfCreatedNotification']);
Route::get('/GetAdminNotificationByUser/{user_id}', [NotificationController::class, 'GetAdminNotificationByUser']);
Route::get('/CountLastestNotification/{user_id}', [NotificationController::class, 'CountLastestNotification']);
Route::get('/SetUnreadStatus/{user_id}', [NotificationController::class, 'SetUnreadStatus']);
Route::get('/SetReadStatus/{user_id}/{notification_id}', [NotificationController::class, 'SetReadStatus']);



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::fallback(function () {
    abort(404);
});
