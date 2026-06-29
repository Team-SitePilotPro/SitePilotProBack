<?php

declare(strict_types=1);

namespace App\Actions\Client;

use App\Dto\ClientDto;
use App\Models\Client;
use Random\RandomException;

final class UpdateClientAction
{
    /**
     * @throws RandomException
     */
    public function __invoke(
        Client $client,
        ClientDto $clientDto,
    ): Client {
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
