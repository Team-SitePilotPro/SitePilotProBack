<?php

declare(strict_types=1);

namespace App\Actions\Worksite;

use App\Dto\WorksiteDto;
use App\Models\Worksite;
use Random\RandomException;

final class CreateWorksiteAction
{
    // Create a new worksite record and auto-generate a unique code.
    /** @throws RandomException */
    public function __invoke(WorksiteDto $worksiteDto): Worksite
    {
        return Worksite::query()->create([
            'client_id'         => $worksiteDto->clientId,
            'code'              => 'FR' . random_int(10000, 99999) . 'A',
            'name_worksite'     => $worksiteDto->nameWorksite,
            'description'       => $worksiteDto->description,
            'start_date'        => $worksiteDto->startDate,
            'end_date'          => $worksiteDto->endDate,
            'worksite_priority' => $worksiteDto->worksitePriority,
            'worksite_status'   => $worksiteDto->worksiteStatus,
            'street'            => $worksiteDto->street,
            'city'              => $worksiteDto->city,
            'zip_code'          => $worksiteDto->zipCode,
            'country'           => $worksiteDto->country,
        ]);
    }
}
