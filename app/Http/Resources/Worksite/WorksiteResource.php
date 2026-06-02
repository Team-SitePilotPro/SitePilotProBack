<?php

declare(strict_types=1);

namespace App\Http\Resources\Worksite;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorksiteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'client' => $this
                ->whenLoaded(
                    'client',
                    fn () => $this
                        ->resource
                        ->client->contact_name)
            ?? 'Client not found',
            'code' => $this->resource->code,
            'name' => $this->resource->name,
            'description' => $this->resource->description,
            'start_date' => $this->resource->start_date,
            'end_date' => $this->resource->end_date,
            'priority' => $this->resource->priority,
            'status' => $this->resource->status,
            'street' => $this->resource->street,
            'city' => $this->resource->city,
            'zip_code' => $this->resource->zip_code,
            'country' => $this->resource->country,
        ];
    }
}
