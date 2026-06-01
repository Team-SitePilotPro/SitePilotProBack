<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\Type;

class ClientDto
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
        public readonly Type $type,
        public readonly string $siret,
        public readonly string $tvaIntra,
    ) {}

    /**
     * Création du DTO à partir d'un tableau.
     *
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            contactName: $data['contact_name'],
            name: $data['name'] ?? null,
            email: $data['email'],
            company: $data['company'] ?? null,
            phone: $data['phone'],
            street: $data['street'],
            city: $data['city'],
            zipCode: (int) $data['zip_code'],
            country: $data['country'],
            type: $data['type'] instanceof Type
                ? $data['type']
                : Type::from($data['type']),
            siret: $data['siret'],
            tvaIntra: $data['tva_intra'],
        );
    }
}