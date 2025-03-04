<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//site health check
Route::get('check', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'site is up and running',
    ]);
});

//======================user route=======================//
Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'getAllUser']);
    Route::get('/get/{id}', [UserController::class, 'getUserById']);
    Route::post('/create', [UserController::class, 'createUser']);
    Route::put('/update/{id}', [UserController::class, 'updateUser']);
    Route::delete('/delete/{id}', [UserController::class, 'deleteUser']);
});

//=====================booking route=====================//
Route::group(['prefix' => 'booking'], function () {
    Route::get('/', [BookingController::class, 'getAllBookings']);
});
