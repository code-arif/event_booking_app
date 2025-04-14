<?php

use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\BookingController;

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

//=====================auth route=====================//
Route::post('/user-registration', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/user/{id}', [AuthController::class, 'user'])->middleware('auth:sanctum');
Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

//====================event route=====================//
Route::group(['prefix' => 'event'], function () {
    Route::get('/', [EventController::class, 'getAllEvents']);
});