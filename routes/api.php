<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\WorksiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
    
})->middleware('auth:sanctum');

// Routes API versionnées pour les clients et les chantiers
Route::prefix('v1')->name('v1.')->group(function () {

    //Routes API des chantiers
    Route::apiResource('worksite', WorksiteController::class);

    //Routes API des clients
    Route::apiResource('clients', ClientController::class);

    Route::apiResource('users', UserController::class);
});