<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceGen\InvoiceGenResource;
use App\Models\InvoiceSubcontractor;
use App\Services\InvoiceSubcontractorService;
use Illuminate\Http\Request;

class InvoiceSubcontractorController extends Controller
{
    public function __construct(
        private readonly InvoiceSubcontractorService $invoiceSubcontractorService,
    ) {
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InvoiceGenResource::collection(
            $this->invoiceSubcontractorService->list()
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
    public function show(InvoiceSubcontractor $invoiceSubcontractor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceSubcontractor $invoiceSubcontractor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceSubcontractor $invoiceSubcontractor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceSubcontractor $invoiceSubcontractor)
    {
        //
    }
}
