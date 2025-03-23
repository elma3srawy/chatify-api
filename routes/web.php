<?php

use App\Http\Middleware\Guest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;


Route::middleware([Guest::class])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/login', 'login');
        Route::post('/register', 'register');

    });
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('/logout', 'logout');
    });
});
