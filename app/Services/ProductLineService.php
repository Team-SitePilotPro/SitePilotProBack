<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\ProductLine;
use App\Models\Quote;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductLineService
{
    public function list(): LengthAwarePaginator
    {
        return ProductLine::query()
            ->latest()
            ->paginate(15
            );
    }

//    public function store(ProductLine $productLine): Quote
//    {
//        /** @var ProductLine $createProductLine */
//
//
//        $createProductLine->refresh();
//
//        return $createProductLine;
//    }
//
//    public function update(
//        ProductLine $productLine,
//        ProductLineDto $productLineDto
//    ): ProductLine {
//        /** @var ProductLine $updateProductLine */
//
//        $updateProductLine->refresh();
//
//        return $updateProductLine;
//    }

    public function destroy(ProductLine $productLine): void
    {
        $productLine->delete();
    }
}
