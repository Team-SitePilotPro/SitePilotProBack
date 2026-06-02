<?php

declare(strict_types=1);

namespace App\Http\Resources\Client;

// Importation des classes nécessaires.
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Client
 */
class ClientResource extends JsonResource
{
    /**
     * Transforme le client en tableau JSON.

     *
     * @return array<string,mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'contact_name' => $this->contact_name,

            'name' => $this->name,

            'email' => $this->email,

            'company' => $this->company,

            'phone' => $this->phone,

            'street' => $this->street,

            'city' => $this->city,

            'zip_code' => $this->zip_code,

            'country' => $this->country,

            'type' => $this->type,

            'siret' => $this->siret,

            'tva_intra' => $this->tva_intra,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

            // Relation des chantiers du client
            'worksites' => $this->whenLoaded('worksites'),
        ];
    }
}
