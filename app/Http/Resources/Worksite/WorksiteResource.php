<?php

declare(strict_types=1);

namespace App\Http\Resources\Worksite;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin \App\Models\Worksite */
class WorksiteResource extends JsonResource
{
    // Transform the worksite model into a JSON-serializable array.
    /** @return array<string, mixed> */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'client'            => $this->whenLoaded('client', fn () => $this->client->contact_name),
            'code'              => $this->code,
            'name_worksite'     => $this->name_worksite,
            'description'       => $this->description,
            'start_date'        => $this->start_date,
            'end_date'          => $this->end_date,
            'worksite_priority' => $this->worksite_priority,
            'worksite_status'   => $this->worksite_status,
            'street'            => $this->street,
            'city'              => $this->city,
            'zip_code'          => $this->zip_code,
            'country'           => $this->country,
            'created_at'        => $this->created_at,
            'updated_at'        => $this->updated_at,
        ];
    }
}
