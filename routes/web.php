<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SslCommerzPaymentController;


//Home page
Route::view('/', 'welcome');

    // SSLCOMMERZ Start
    // Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
    Route::get('/online-payment', [SslCommerzPaymentController::class, 'onlineSSLPayment']);

    Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
    // Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

    Route::post('/success', [SslCommerzPaymentController::class, 'success']);
    Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
    Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

    Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
    //SSLCOMMERZ END


Route::fallback(function () {
    abort(404);
});
