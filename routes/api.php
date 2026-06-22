<?php

declare(strict_types=1);

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WorksiteController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->name('auth.')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('logout');
    Route::get('me', [AuthController::class, 'me'])->middleware('auth:sanctum')->name('me');
});

Route::middleware('auth:sanctum')->prefix('v1')->name('v1.')->group(function () {

    // Accessible to all authenticated users.
    Route::apiResource('worksites', WorksiteController::class);
    Route::apiResource('clients', ClientController::class);
    Route::get('clients/{client}/worksites', [ClientController::class, 'listWorksites']);

    // Restricted to admin only.
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });
});
