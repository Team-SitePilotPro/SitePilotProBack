<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceGen\InvoiceGenResource;
use App\Models\InvoiceSupplier;
use App\Services\InvoiceSupplierService;
use Illuminate\Http\Request;

class InvoiceSupplierController extends Controller
{
    public function __construct(
        private readonly InvoiceSupplierService $invoiceSupplierService,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InvoiceGenResource::collection(
            $this->invoiceSupplierService->list()
        )->response();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceSupplier $invoiceSupplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceSupplier $invoiceSupplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceSupplier $invoiceSupplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceSupplier $invoiceSupplier)
    {
        //
    }
}
