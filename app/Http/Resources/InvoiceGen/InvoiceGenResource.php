<?php

namespace App\Http\Resources\InvoiceGen;

use App\Http\Resources\Worksite\IndexWorksiteResource;
use App\Models\InvoiceOther;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Override;

/**
 * @property InvoiceOther $resource
 */
class InvoiceGenResource extends JsonResource
{
    /**
    * Transform the resource into an array.
    *
    * @return array<string, mixed>
    */
    #[Override]
    public function toArray(Request $request): array
    {
        /** @var Money|null $totalHt */
        $purchasePrice = $this->resource->purchase_price;
        /** @var Money|null $cost_price */
        $cost_price = $this->resource->cost_price;

        return[
            'id' => $this->resource->id,
            'delivery_date' => $this->resource->delivery_date,
            'number_invoice' => $this->resource->number_invoice,
            'invoice_description' => $this->resource->invoice_description,
            'purchase_price' => $purchasePrice,
            'cost_price' => $cost_price,
            'worksite' => $this
                ->whenLoaded(
                    'worksite',
                    fn () => IndexWorksiteResource::make($this->resource->worksite)),
        ];
    }
}
