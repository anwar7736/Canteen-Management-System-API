<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::fallback(function () {
    abort(404);
});
