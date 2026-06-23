<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Quote;
use App\Models\Workforce;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class WorkforceService
{
    public function list(): LengthAwarePaginator
    {
        return Workforce::query()
            ->with('worksite')
            ->latest()
            ->paginate(15
            );
    }
}
