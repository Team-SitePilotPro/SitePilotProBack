<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\WorksiteDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorksiteRequest;
use App\Http\Resources\Worksite\IndexWorksiteResource;
use App\Http\Resources\Worksite\ShowWorksiteResource;
use App\Models\Worksite;
use App\Services\WorksiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class WorksiteController extends Controller
{
    public function __construct(
        private readonly WorksiteService $worksiteService,
    ) {
    }

    public function index(): JsonResponse
    {
        return IndexWorksiteResource::collection(
            $this->worksiteService->list()
        )->response();
    }

    public function show(int $worksite_id): JsonResponse
    {
        /** @var Worksite $worksite */
        $worksite = Worksite::query()->findOrFail($worksite_id);

        $worksite->loadMissing('client');

        return ShowWorksiteResource::make($worksite)->response();
    }

    public function store(WorksiteRequest $worksiteRequest): JsonResponse
    {
        $validated = $worksiteRequest->safe()->toArray();

        /** @var Worksite $createdWorksite */
        $createdWorksite = DB::transaction(
            fn () => $this->worksiteService->store(
                WorksiteDto::fromArray($validated)
            )
        );

        $createdWorksite->loadMissing('client');

        return ShowWorksiteResource::make($createdWorksite)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }

    public function update(
        int $worksite_id,
        WorksiteRequest $worksiteRequest
    ): JsonResponse {
        $validated = $worksiteRequest->safe()->toArray();

        /** @var Worksite $worksite */
        $worksite = Worksite::query()->findOrFail($worksite_id);

        $updateWorksite = DB::transaction(
            fn () => $this->worksiteService->update(
                $worksite,
                WorksiteDto::fromArray($validated)
            )
        );
        $updateWorksite->loadMissing('client');

        return ShowWorksiteResource::make($updateWorksite)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function destroy(int $worksite_id): JsonResponse
    {
        /** @var Worksite $worksite */
        $worksite = Worksite::query()->findOrFail($worksite_id);
        $worksite->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
