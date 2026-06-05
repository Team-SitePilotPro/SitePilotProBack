<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\ClientType;

final readonly class ClientDto
{
    public function __construct(
        public string $contactName,
        public ?string $privateName,
        public string $email,
        public ?string $company,
        public string $phone,
        public string $street,
        public string $city,
        public int $zipCode,
        public string $country,
        public ClientType $clientType,
        public string $siret,
        public string $tvaIntra,
    ) {
    }

    /**
     * @param  array<string,mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            contactName: $data['contact_name'],
            privateName: $data['private_name'] ?? null,
            email: $data['email'],
            company: $data['company'] ?? null,
            phone: $data['phone'],
            street: $data['street'],
            city: $data['city'],
            zipCode: (int) $data['zip_code'],
            country: $data['country'],
            clientType: $data['clientType'] instanceof ClientType
                ? $data['clientType']
                : ClientType::from($data['clientType']),
            siret: $data['siret'],
            tvaIntra: $data['tva_intra'],
        );
    }
}
