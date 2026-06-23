<?php

namespace App\Http\Resources\Quote;

use App\Http\Resources\Client\IndexClientResource;
use App\Http\Resources\ProductLine\IndexProductLineResource;
use App\Http\Resources\Worksite\IndexWorksiteResource;
use App\Models\Quote;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Quote $resource
 */
class QuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Money|null $subtotalHt */
        $subtotalHt = $this->resource->subtotal_ht;
        /** @var Money|null $tvaAmount */
        $tvaAmount = $this->resource->tva_amount;
        /** @var Money|null $totalTtc */
        $totalTtc = $this->resource->total_ttc;

        return [
            'id'            => $this->resource->id,
            'quote_number'  => $this->resource->quote_number,
            'issue_date'    => $this->resource->issue_date->format('d/m/Y'),
            'validity_date' => $this->resource->validity_date->format('d/m/Y'),
            'quote_status'  => $this->resource->quote_status,
            'subtotal_ht'   => $subtotalHt,
            'tva_rate'      => $this->resource->tva_rate,
            'tva_amount'    => $tvaAmount,
            'total_ttc'     => $totalTtc,
            'client' => $this
                ->whenLoaded(
                    'client',
                    fn () => IndexClientResource::make($this->resource->client)),
            'worksites' => $this
                ->whenLoaded(
                    'worksites',
                    fn () => IndexWorksiteResource::collection($this->resource->worksites)),
            'product_lines' => $this
                ->whenLoaded(
                    'productLines',
                    fn () => IndexProductLineResource::collection($this->resource->productLines)),
            'product_lines_count' => $this->whenCounted('productLines'),
        ];
    }
}
