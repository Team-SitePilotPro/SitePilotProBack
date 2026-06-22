<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\ClientDto;
use App\Models\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;

class ClientService
{
    // Return all clients ordered by creation date.
    public function list(): Collection
    {
        return Client::query()->latest()->get();
    }

    // Create a new client and assign it to the authenticated user.
    public function store(ClientDto $clientDto): Client
    {
        return Client::query()->create([
            'user_id'      => Auth::id(),
            'contact_name' => $clientDto->contactName,
            'name'         => $clientDto->name,
            'email'        => $clientDto->email,
            'company'      => $clientDto->company,
            'phone'        => $clientDto->phone,
            'street'       => $clientDto->street,
            'city'         => $clientDto->city,
            'zip_code'     => $clientDto->zipCode,
            'country'      => $clientDto->country,
            'type'         => $clientDto->type,
            'siret'        => $clientDto->siret,
            'tva_intra'    => $clientDto->tvaIntra,
        ]);
    }

    // Update an existing client with new data.
    public function update(Client $client, ClientDto $clientDto): Client
    {
        $client->update([
            'contact_name' => $clientDto->contactName,
            'name'         => $clientDto->name,
            'email'        => $clientDto->email,
            'company'      => $clientDto->company,
            'phone'        => $clientDto->phone,
            'street'       => $clientDto->street,
            'city'         => $clientDto->city,
            'zip_code'     => $clientDto->zipCode,
            'country'      => $clientDto->country,
            'type'         => $clientDto->type,
            'siret'        => $clientDto->siret,
            'tva_intra'    => $clientDto->tvaIntra,
        ]);

        return $client->refresh();
    }
}
