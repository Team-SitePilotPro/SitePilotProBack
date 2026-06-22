<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\Worksite\CreateWorksiteAction;
use App\Actions\Worksite\UpdateWorksiteAction;
use App\Dto\WorksiteDto;
use App\Models\Worksite;
use Illuminate\Database\Eloquent\Collection;

class WorksiteService
{
    // Return all worksites with their related client.
    public function list(): Collection
    {
        return Worksite::query()->with('client')->latest()->get();
    }

    // Create a new worksite using the dedicated action.
    public function store(WorksiteDto $worksiteDto): Worksite
    {
        return app()->call(CreateWorksiteAction::class, ['worksiteDto' => $worksiteDto]);
    }

    // Update an existing worksite using the dedicated action.
    public function update(Worksite $worksite, WorksiteDto $worksiteDto): Worksite
    {
        return app()->call(UpdateWorksiteAction::class, [
            'worksite'     => $worksite,
            'worksiteDto'  => $worksiteDto,
        ]);
    }

    // Soft-delete a worksite.
    public function destroy(Worksite $worksite): void
    {
        $worksite->delete();
    }
}
