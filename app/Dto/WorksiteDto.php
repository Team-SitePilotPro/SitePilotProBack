<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\WorksitePriority;
use App\Enums\WorksiteStatus;
use Illuminate\Support\Carbon;

// Data Transfer Object for worksite create and update operations.
final readonly class WorksiteDto
{
    public function __construct(
        public int              $clientId,
        public string           $nameWorksite,
        public ?string          $description,
        public ?Carbon          $startDate,
        public ?Carbon          $endDate,
        public WorksitePriority $worksitePriority,
        public WorksiteStatus   $worksiteStatus,
        public ?string          $street,
        public ?string          $city,
        public ?int             $zipCode,
        public ?string          $country,
    ) {}

    // Build a WorksiteDto from a validated request array.
    /** @param array<string,mixed> $data */
    public static function fromArray(array $data): self
    {
        return new self(
            clientId:         (int) $data['client_id'],
            nameWorksite:     (string) $data['name_worksite'],
            description:      $data['description'] ?? null,
            startDate:        isset($data['start_date']) ? Carbon::parse($data['start_date']) : null,
            endDate:          isset($data['end_date']) ? Carbon::parse($data['end_date']) : null,
            worksitePriority: $data['worksite_priority'] instanceof WorksitePriority
                ? $data['worksite_priority']
                : WorksitePriority::from($data['worksite_priority']),
            worksiteStatus:   $data['worksite_status'] instanceof WorksiteStatus
                ? $data['worksite_status']
                : WorksiteStatus::from($data['worksite_status']),
            street:           $data['street'] ?? null,
            city:             $data['city'] ?? null,
            zipCode:          isset($data['zip_code']) ? (int) $data['zip_code'] : null,
            country:          $data['country'] ?? null,
        );
    }
}
