<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\Priority;
use App\Enums\Status;
use ArrayAccess;
use Illuminate\Support\Carbon;

final readonly class WorksiteDto
{
    public function __construct(
        public  int $client_id,
        public  string $name,
        public  ?string $description,
        public  ?Carbon $start_date,
        public  ?Carbon $end_date,
        public  Priority $priority,
        public  Status $status,
        public  string $street,
        public  string $city,
        public  int $zip_code,
        public  string $country,

    ){}

    /**
     * @param  array<string,scalar|null>|ArrayAccess  $data
     */
    public static function fromArray(array|ArrayAccess $data): self
    {
        return new self(
            client_id: (int) $data['client_id'],
            name: (string) $data['name'],
            description: $data['description'] ?? null,
            start_date: isset($data['start_date'])
                ? Carbon::parse($data['start_date'])
                : null,
            end_date: isset($data['end_date'])
                ? Carbon::parse($data['end_date'])
                : null,
            priority: Priority::from($data['priority']),
            status: Status::from($data['status']),
            street: (string) $data['street'],
            city: (string) $data['city'],
            zip_code: (int) $data['zip_code'],
            country: (string) $data['country'],
        );
    }
}
