<?php

declare(strict_types=1);

namespace App\Http\Resources\Client;

use App\Http\Resources\Worksite\WorksiteResource;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property Client $resource
 */
final class ClientResource extends JsonResource
{
    /**
     *
     * @return array<string,mixed>
     */
    #[\Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'contact_name' => $this->resource->contact_name,
            'private_name' => $this->resource->private_name,
            'email' => $this->resource->email,
            'company' => $this->resource->company,
            'phone' => $this->resource->phone,
            'street' => $this->resource->street,
            'city' => $this->resource->city,
            'zip_code' => $this->resource->zip_code,
            'country' => $this->resource->country,
            'clientType' => $this->resource->clientType,
            'siret' => $this->resource->siret,
            'tva_intra' => $this->resource->tva_intra,
            'worksites' => $this->whenLoaded(
                'worksites',
            fn () => WorksiteResource::collection($this->resource->worksites)),
        ];
    }
}
