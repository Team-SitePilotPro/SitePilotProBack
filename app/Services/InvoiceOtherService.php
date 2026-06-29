<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\InvoiceClient;
use App\Models\InvoiceOther;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceOtherService
{
    public function list(): LengthAwarePaginator
    {
        return InvoiceOther::query()
            ->with('worksite')
            ->paginate(20);
    }

    public function destroy(InvoiceClient $invoiceClient): void
    {
        $invoiceClient->delete();
    }
}
