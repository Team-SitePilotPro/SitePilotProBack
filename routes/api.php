<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\WorksiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->name('v1.')->group(function () {

    Route::apiResource('worksite', WorksiteController::class);
    Route::apiResource('clients', ClientController::class);
});
