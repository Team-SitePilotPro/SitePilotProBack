<?php

declare(strict_types=1);

namespace App\Actions\Worksite;

use App\Dto\WorksiteDto;
use App\Models\Worksite;

final class UpdateWorksiteAction
{
    // Update an existing worksite with new data from the DTO.
    public function __invoke(Worksite $worksite, WorksiteDto $worksiteDto): Worksite
    {
        $worksite->update([
            'client_id'         => $worksiteDto->clientId,
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

        return $worksite->refresh();
    }
}
