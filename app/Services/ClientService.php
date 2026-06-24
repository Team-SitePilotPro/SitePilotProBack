<?php

declare(strict_types=1);

namespace App\Services;

use App\Dto\ClientDto;
use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientService
{
    // Retourne la liste de tous les clients.
    public function list(): LengthAwarePaginator
    {
        return Client::query()
            ->latest()
            ->paginate(20);
    }

    // Crée un nouveau client.
    public function store(ClientDto $clientDto): Client
    {
        return Client::query()->create([
            'contact_name' => $clientDto->contactName,
            'private_name' => $clientDto->privateName,
            'email' => $clientDto->email,
            'company' => $clientDto->company,
            'phone' => $clientDto->phone,
            'street' => $clientDto->street,
            'city' => $clientDto->city,
            'zip_code' => $clientDto->zipCode,
            'country' => $clientDto->country,
            'client_type' => $clientDto->clientType,
            'siret' => $clientDto->siret,
            'tva_intra' => $clientDto->tvaIntra,
        ]);
    }

    public function update(Client $client, ClientDto $clientDto): Client
    {
        $client->update([
            'contact_name' => $clientDto->contactName,
            'private_name' => $clientDto->privateName,
            'email' => $clientDto->email,
            'company' => $clientDto->company,
            'phone' => $clientDto->phone,
            'street' => $clientDto->street,
            'city' => $clientDto->city,
            'zip_code' => $clientDto->zipCode,
            'country' => $clientDto->country,
            'client_type' => $clientDto->clientType,
            'siret' => $clientDto->siret,
            'tva_intra' => $clientDto->tvaIntra,
        ]);

        return $client->refresh();
    }
}
