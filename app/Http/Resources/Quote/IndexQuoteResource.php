<?php

declare(strict_types=1);

namespace App\Http\Resources\Quote;

use App\Http\Resources\Client\IndexClientResource;
use App\Models\Quote;
use Cknow\Money\Money;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Override;

/**
 * @property Quote $resource
 */
class IndexQuoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    #[Override]
    public function toArray(Request $request): array
    {
        /** @var Money|null $subtotalHt */
        $subtotalHt = $this->resource->subtotal_ht;
        /** @var Money|null $tvaAmount */
        $tvaAmount = $this->resource->tva_amount;
        /** @var Money|null $totalTtc */
        $totalTtc = $this->resource->total_ttc;

        return [
            'id' => $this->resource->id,
            'quote_number' => $this->resource->quote_number,
            'issue_date' => $this->resource->issue_date->format('d/m/Y'),
            'quote_status' => $this->resource->quote_status,
            'subtotal_ht' => $subtotalHt,
            'tva_rate' => $this->resource->tva_rate,
            'client' => $this
                ->whenLoaded(
                    'client',
                    fn () => IndexClientResource::make($this->resource->client)),
        ];
    }
}
