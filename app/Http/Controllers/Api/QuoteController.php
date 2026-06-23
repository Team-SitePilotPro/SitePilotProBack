<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Quote\QuoteResource;
use App\Models\Quote;
use App\Services\QuoteService;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    public function __construct(
        private readonly QuoteService $quoteService,
    ) {
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return QuoteResource::collection(
            $this->quoteService->list()
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
    public function show(Quote $quote)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Quote $quote)
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {

    }
}
