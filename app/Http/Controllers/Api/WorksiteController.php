<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\AddressDto;
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
    ){}

    public function index(): JsonResponse
    {
        return WorksiteResource::collection(
            $this->worksiteService->list()

        )->response();
    }

    public function show(Worksite $worksite): JsonResponse
    {
        $worksite->loadMissing('client');

        return WorksiteResource::make($worksite)->response();
    }

    public function store(WorksiteRequest $worksiteRequest): JsonResponse
    {
        $validated = $worksiteRequest->safe()->toArray();

        /** @var Worksite $createWorksite*/
        $createdWorksite= DB::transaction(
            fn() => $this->worksiteService->store(
                WorksiteDto::fromArray($validated)
            )
        );

        $createdWorksite->loadMissing('client');

        return WorksiteResource::make($createdWorksite)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);

    }
    
    // Met à jour un chantier existant.
    public function update(
        Worksite $worksite,
        WorksiteRequest $worksiteRequest
    ): JsonResponse
    {
        $validated = $worksiteRequest->safe()->toArray();
        // Crée un DTO d'adresse à partir des données validées
        /** @var Worksite $updateWorksite */
        $updateWorksite = DB::transaction(
            fn() => $this->worksiteService->update(
                $worksite,
                WorksiteDto::fromArray($validated)
            )
        );
        // Charge la relation client si elle n'est pas déjà chargée
        $updateWorksite->loadMissing('client');

        return WorksiteResource::make($updateWorksite)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // Supprime un chantier.
    public function destroy(Worksite $worksite): JsonResponse
    {
        $worksite->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
