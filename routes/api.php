<?php

use Illuminate\Http\Request;
use App\Http\Middleware\Guest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Conversation\ConversationController;


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

    Route::controller(ConversationController::class)->group(function () {
        Route::get('/all' , "index");
        Route::get('/get-chat/{chat}' , "getChat");
        Route::get('/set-status' , "getStatus");
        Route::post('/send-message' , "sendMessage");
        Route::post('/set-online' , "setOnline");
        Route::post('/set-offline' , "setOffline");

    });

});
