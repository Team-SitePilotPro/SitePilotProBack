<?php

namespace App\Http\Resources\ProductLine;

use App\Http\Resources\Quote\QuoteResource;
use App\Models\ProductLine;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property ProductLine $resource
 */
class IndexProductLineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Money|null $unitPriceHt */
        $unitPriceHt = $this->resource->unit_price_ht;
        /** @var Money|null $totalHt */
        $totalHt= $this->resource->total_ht;
        /** @var Money|null $totalTtc */
        $totalTtc = $this->resource->total_ttc;

        return [
            'id'            => $this->resource->id,
            'quote_id'      => $this->resource->quote_id,
            'description'   => $this->resource->description,
            'quantity'      => $this->resource->quantity,
            'unit'          => $this->resource->unit,
            'unit_price_ht' => $unitPriceHt,
            'tva_rate'      => $this->resource->tva_rate,
            'total_ht'      => $totalHt,
            'total_ttc'     => $totalTtc,
            'sort_order'    => $this->resource->sort_order,
            'category'      => $this->resource->category,
        ];
    }
}
