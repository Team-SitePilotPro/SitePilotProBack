<?php

declare(strict_types=1);

namespace App\Http\Resources\Worksite;

use App\Http\Resources\Client\ClientResource;
use App\Models\Worksite;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Override;

/**
 * @property Worksite $resource
 */
final class WorksiteResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    #[Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'client' => $this
                ->whenLoaded(
                    'clients',
                    fn () => ClientResource::collection($this->resource->client)),
            'code' => $this->resource->code,
            'name_worksite' => $this->resource->name_worksite,
            'description' => $this->resource->description,
            'start_date' => $this->resource->start_date,
            'end_date' => $this->resource->end_date,
            'worksite_priority' => $this->resource->worksite_priority,
            'worksite_status' => $this->resource->worksite_status,
            'street' => $this->resource->street,
            'city' => $this->resource->city,
            'zip_code' => $this->resource->zip_code,
            'country' => $this->resource->country,
        ];
    }
}
