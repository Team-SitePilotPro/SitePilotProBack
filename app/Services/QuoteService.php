<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Quote;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class QuoteService
{
    public function list(): LengthAwarePaginator
    {
        return Quote::query()
            ->with([
                'client',
                'productLines',
                'worksites',
            ])
            ->withCount('productLines')
            ->latest()
            ->paginate(15
            );
    }

//    public function store(Quote $quote): Quote
//    {
//        /** @var Quote $createQuote */
//
//
//        $createQuote->refresh();
//
//        return $createQuote;
//    }
//
//    public function update(
//        Quote $quote,
//        QuoteDto $quoteDto
//    ): Quote {
//        /** @var Quote $updateQuote */
//
//        $updateQuote->refresh();
//
//        return $updateQuote;
//    }

    public function destroy(Quote $quote): void
    {
        $quote->delete();
    }
}
