<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\InvoiceClient;
use App\Models\InvoiceSupplier;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceSupplierService
{
    public function list(): LengthAwarePaginator
    {
        return InvoiceSupplier::query()
            ->with('worksite')
            ->paginate(20);
    }

    public function destroy(InvoiceClient $invoiceClient): void
    {
        $invoiceClient->delete();
    }
}
