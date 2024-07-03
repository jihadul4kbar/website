<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApiAuthController;
use App\Http\Controllers\API\ApiBeritaController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('register', [ApiAuthController::class, 'register']);
Route::post('login', [ApiAuthController::class, 'login']);

Route::middleware('auth:api')->group( function () {
    Route::resource('berita', ApiBeritaController::class);
    Route::post('logout', [ApiAuthController::class, 'logout']);
    Route::get("dashboard",[ApiAuthController::class, "dashboard"]);
});