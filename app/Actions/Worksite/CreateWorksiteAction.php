<?php

declare(strict_types=1);

namespace App\Actions\Worksite;

use App\Dto\WorksiteDto;
use App\Models\Worksite;
use Random\RandomException;

final class CreateWorksiteAction
{
    /**
     * @throws RandomException
     */
    public function __invoke(
        WorksiteDto $worksiteDto,
    ): Worksite {

        return Worksite::query()->create([
            'client_id' => $worksiteDto->client_id,
            'code' => $worksiteDto->code ?? 'FR'.random_int(10000, 99999).'A',
            'name' => $worksiteDto->name,
            'description' => $worksiteDto->description,
            'start_date' => $worksiteDto->start_date,
            'end_date' => $worksiteDto->end_date,
            'priority' => $worksiteDto->priority,
            'status' => $worksiteDto->status,
            'street' => $worksiteDto->street,
            'city' => $worksiteDto->city,
            'zip_code' => $worksiteDto->zip_code,
            'country' => $worksiteDto->country,
        ]);
    }
}
