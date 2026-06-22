<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\WorksiteDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\WorksiteRequest;
use App\Http\Resources\Worksite\WorksiteResource;
use App\Models\Worksite;
use App\Services\WorksiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class WorksiteController extends Controller
{
    public function __construct(
        private readonly WorksiteService $worksiteService,
    ) {}

    // Return the list of all worksites with their related client.
    public function index(): JsonResponse
    {
        return WorksiteResource::collection(
            $this->worksiteService->list()
        )->response();
    }

    // Return the details of a specific worksite.
    public function show(Worksite $worksite): JsonResponse
    {
        $worksite->loadMissing('client');

        return WorksiteResource::make($worksite)->response();
    }

    // Create a new worksite.
    public function store(WorksiteRequest $worksiteRequest): JsonResponse
    {
        $validated = $worksiteRequest->safe()->toArray();

        /** @var Worksite $createdWorksite */
        $createdWorksite = DB::transaction(
            fn () => $this->worksiteService->store(WorksiteDto::fromArray($validated))
        );

        $createdWorksite->loadMissing('client');

        return WorksiteResource::make($createdWorksite)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // Update an existing worksite.
    public function update(Worksite $worksite, WorksiteRequest $worksiteRequest): JsonResponse
    {
        $validated = $worksiteRequest->safe()->toArray();

        /** @var Worksite $updatedWorksite */
        $updatedWorksite = DB::transaction(
            fn () => $this->worksiteService->update(
                $worksite,
                WorksiteDto::fromArray($validated)
            )
        );

        $updatedWorksite->loadMissing('client');

        return WorksiteResource::make($updatedWorksite)->response();
    }

    // Soft-delete a worksite.
    public function destroy(Worksite $worksite): JsonResponse
    {
        $this->worksiteService->destroy($worksite);

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
