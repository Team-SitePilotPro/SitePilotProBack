<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\ClientType;

final readonly class ClientDto
{
    public function __construct(
        public readonly string $contactName,
        public readonly ?string $name,
        public readonly string $email,
        public readonly ?string $company,
        public readonly string $phone,
        public readonly string $street,
        public readonly string $city,
        public readonly int $zipCode,
        public readonly string $country,
        public readonly ClientType $type,
        public readonly string $siret,
        public readonly string $tvaIntra,
    ) {}

    /**
     * @param  array<string,mixed>  $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            contactName: $data['contact_name'],
            name: $data['private_name'] ?? null,
            email: $data['email'],
            company: $data['company'] ?? null,
            phone: $data['phone'],
            street: $data['street'],
            city: $data['city'],
            zipCode: (int) $data['zip_code'],
            country: $data['country'],
            type: $data['client_type'] instanceof ClientType
                ? $data['client_type']
                : ClientType::from($data['client_type']),
            siret: $data['siret'],
            tvaIntra: $data['tva_intra'],
        );
    }
}
