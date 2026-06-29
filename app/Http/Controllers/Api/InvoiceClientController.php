<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceClient\InvoiceClientResource;
use App\Models\InvoiceClient;
use App\Services\InvoiceClientService;
use Illuminate\Http\Request;

class InvoiceClientController extends Controller
{
    public function __construct(
        private readonly InvoiceClientService $invoiceClientService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InvoiceClientResource::collection(
            $this->invoiceClientService->list()
        )->response();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(InvoiceClient $invoiceClient)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InvoiceClient $invoiceClient)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InvoiceClient $invoiceClient)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InvoiceClient $invoiceClient)
    {

    }
}
