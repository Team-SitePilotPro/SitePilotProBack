<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\InvoiceClient;
use App\Models\InvoiceSubcontractor;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceSubcontractorService
{
    public function list(): LengthAwarePaginator
    {
        return InvoiceSubcontractor::query()
            ->with('worksite')
            ->paginate(20);
    }

    public function destroy(InvoiceClient $invoiceClient): void
    {
        $invoiceClient->delete();
    }
}
