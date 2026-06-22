<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\ClientDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\Client\ClientResource;
use App\Http\Resources\Worksite\WorksiteResource;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientService $clientService,
    ) {
    }

    // Return the list of all clients.
    public function index(): JsonResponse
    {
        return ClientResource::collection(
            $this->clientService->list()
        )->response();
    }

    // Return the details of a specific client.
    public function show(Client $client): JsonResponse
    {
        return ClientResource::make($client)->response();
    }

    // Create a new client.
    public function store(ClientRequest $clientRequest): JsonResponse
    {
        $validated = $clientRequest->safe()->toArray();

        /** @var Client $createdClient */
        $createdClient = DB::transaction(
            fn () => $this->clientService->store(ClientDto::fromArray($validated))
        );

        return ClientResource::make($createdClient)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // Update an existing client.
    public function update(Client $client, ClientRequest $clientRequest): JsonResponse
    {
        /** @var Client $updatedClient */
        $updatedClient = DB::transaction(
            fn () => $this->clientService->update(
                $client,
                ClientDto::fromArray($clientRequest->safe()->toArray())
            )
        );

        return ClientResource::make($updatedClient)->response();
    }

    // Soft-delete a client.
    public function destroy(Client $client): JsonResponse
    {
        $client->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }

    // Return all worksites belonging to a specific client.
    public function listWorksites(Client $client): JsonResponse
    {
        return WorksiteResource::collection($client->worksites)->response();
    }
}
