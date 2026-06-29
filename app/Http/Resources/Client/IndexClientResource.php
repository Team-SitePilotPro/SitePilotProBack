<?php

declare(strict_types=1);

namespace App\Http\Resources\Client;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Override;

/**
 * @property Client $resource
 */
final class IndexClientResource extends JsonResource
{
    /**
     * @return array<string,mixed>
     */
    #[Override]
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'contact_name' => $this->resource->contact_name,
            'private_name' => $this->resource->private_name,
            'email' => $this->resource->email,
            'company' => $this->resource->company,
            'phone' => $this->resource->phone,
            'clientType' => $this->resource->clientType,
        ];
    }
}
