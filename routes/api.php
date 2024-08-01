<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use Orion\Facades\Orion;

Route::group(['as' => 'api.'], function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::group(['middleware' => 'auth:api'], function () {
        Route::get('me', [AuthController::class, 'me']);
        Orion::resource('users', \App\Http\Controllers\Api\UserController::class);
        Orion::resource('trainings', \App\Http\Controllers\Api\TrainingController::class);
        Orion::resource('user_trainings' , \App\Http\Controllers\Api\UserTrainingController::class);
    });
});

Route::post('/test', [\App\Http\Controllers\Api\UserController::class, 'test']);
