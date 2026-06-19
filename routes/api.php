<?php

declare(strict_types=1);

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\InvoiceClientController;
use App\Http\Controllers\Api\InvoiceOtherController;
use App\Http\Controllers\Api\InvoiceSubcontractorController;
use App\Http\Controllers\Api\InvoiceSupplierController;
use App\Http\Controllers\Api\ProductLineController;
use App\Http\Controllers\Api\QuoteController;
use App\Http\Controllers\Api\WorkforceController;
use App\Http\Controllers\Api\WorksiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', fn (Request $request) => $request->user())->middleware('auth:sanctum');

Route::prefix('v1')->name('v1.')->group(function (): void {

    Route::apiResource('worksites', WorksiteController::class)
        ->parameter('worksites', 'worksite_id')
        ->whereNumber('worksite_id');

    Route::apiResource('clients', ClientController::class)
        ->parameter('clients', 'client_id')
        ->whereNumber('client_id');

    Route::apiResource('quotes', QuoteController::class)
        ->parameter('quotes', 'quote_id')
        ->whereNumber('quote_id');

    Route::apiResource('ProductLines', ProductLineController::class)
        ->parameter('ProductLines', 'ProductLine_id')
        ->whereNumber('ProductLine_id');

    Route::apiResource('invoice_clients', InvoiceClientController::class)
        ->only('index');

    Route::apiResource('invoice_others', InvoiceOtherController::class)
        ->only('index');

    Route::apiResource('invoice_Subcontractors', InvoiceSubcontractorController::class)
        ->only('index');

    Route::apiResource('invoice_suppliers', InvoiceSupplierController::class)
        ->only('index');

    Route::apiResource('workforces', WorkforceController::class)
        ->only('index');
});
