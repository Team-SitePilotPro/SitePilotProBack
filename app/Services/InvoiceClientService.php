<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\InvoiceClient;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InvoiceClientService
{
    public function list(): LengthAwarePaginator
    {
        return InvoiceClient::query()
            ->with('client', 'worksite', 'quote')
            ->paginate(20);
    }

    public function destroy(InvoiceClient $invoiceClient): void
    {
        $invoiceClient->delete();
    }
}
