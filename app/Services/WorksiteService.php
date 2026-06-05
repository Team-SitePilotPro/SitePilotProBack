<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Worksite\CreateWorksiteAction;
use App\Actions\Worksite\UpdateWorksiteAction;
use App\Dto\WorksiteDto;
use App\Models\Worksite;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WorksiteService
{
    public function list(): LengthAwarePaginator
    {
        return Worksite::query()
            ->with('client')
            ->paginate(20
            );
    }

    public function store(WorksiteDto $worksiteDto): Worksite
    {
        /** @var Worksite $createWorksite */
        $createWorksite = app()->call(CreateWorksiteAction::class, [
            'worksiteDto' => $worksiteDto,
        ]);

        $createWorksite->refresh();

        return $createWorksite;
    }

    public function update(
        Worksite $worksite,
        WorksiteDto $worksiteDto
    ): Worksite {
        /** @var Worksite $updateWorksite */
        $updateWorksite = app()->call(UpdateWorksiteAction::class, [
            'worksite' => $worksite,
            'worksiteDto' => $worksiteDto,
        ]);

        $updateWorksite->refresh();

        return $updateWorksite;
    }

    public function destroy(Worksite $worksite): void
    {
        $worksite->delete();
    }
}
