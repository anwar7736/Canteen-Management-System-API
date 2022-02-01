<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DailyMealItemController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\MealRateController;
use App\Http\Controllers\OrderMealController;
use App\Http\Controllers\DayWiseMealController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PaymentDetailsController;
use App\Http\Controllers\MonthlyStatementController;


//Admin Login
Route::post('/admin_login', [LoginController::class, 'AdminLogin']);

//User Login
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

//Dashboard Summary
Route::get('/CountDashboardSummary/{user_id}', [DashboardController::class, 'CountDashboardSummary']);
Route::get('/LastFivePaymentDetails/{token_no}', [DashboardController::class, 'LastFivePaymentDetails']);
Route::get('/LastFiveMonthsStatements/{token_no}', [DashboardController::class, 'LastFiveMonthsStatements']);
Route::get('/LastSevenDaysMealReport/{user_id}', [DashboardController::class, 'LastSevenDaysMealReport']);

//DayWiseMealItem

Route::get('/GetDailyMealItem', [DailyMealItemController::class, 'GetDayWiseMealItem']);

//Payment Summary
Route::get('/PaymentDetailsByUser/{token_no}', [PaymentDetailsController::class, 'PaymentDetailsByUser']);
Route::post('/PaymentDetailsFilterByDate', [PaymentDetailsController::class, 'PaymentDetailsFilterByDate']);

//Meal Rate
Route::get('/GetMealRate', [MealRateController::class, 'GetMealRate']);
Route::post('/ChangeMealRate', [MealRateController::class, 'ChangeMealRate']);

//OrderDailyMeal
Route::post('/OrderDailyMeal', [OrderMealController::class, 'OrderDailyMeal']);
Route::get('/GetTodayOrderInfo/{user_id}/{token_no}', [OrderMealController::class, 'GetTodayOrderInfo']);
Route::post('/ChangeOrderedMeal', [OrderMealController::class, 'ChangeOrderedMeal']);
Route::get('/DeleteTodayOrderedMeal/{order_id}/{token_no}', [OrderMealController::class, 'DeleteTodayOrderedMeal']);
Route::get('/RestoreTodayOrderedMeal/{order_id}/{token_no}', [OrderMealController::class, 'RestoreTodayOrderedMeal']);

//MonthlyStatement
Route::get('/GetYearsAndMonths', [MonthlyStatementController::class, 'GetYearsAndMonths']);
Route::get('/GetAllMonthlyStatement/{token_no}', [MonthlyStatementController::class, 'GetAllMonthlyStatement']);
Route::post('/GetMonthlyStatementByKey', [MonthlyStatementController::class, 'GetMonthlyStatementByKey']);

//DayWiseMealReportByUser
Route::get('/GetAllMealByUser/{user_id}', [DayWiseMealController::class, 'GetAllMealByUser']);
Route::post('/GetMealFilterByDate', [DayWiseMealController::class, 'GetMealFilterByDate']);

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
