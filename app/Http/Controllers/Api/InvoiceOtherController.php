<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceGen\InvoiceGenResource;
use App\Models\InvoiceOther;
use App\Services\InvoiceOtherService;
use Illuminate\Http\Request;

class InvoiceOtherController extends Controller
{
    public function __construct(
        private readonly InvoiceOtherService $invoiceOtherService,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InvoiceGenResource::collection(
            $this->invoiceOtherService->list()
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
    public function show(InvoiceOther $invoiceOther)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceOther $invoiceOther)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceOther $invoiceOther)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceOther $invoiceOther)
    {
        //
    }
}
