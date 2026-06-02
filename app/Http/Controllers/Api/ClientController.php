<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\ClientDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\Client\ClientResource;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class ClientController extends Controller
{
    public function __construct(
        private readonly ClientService $clientService,
    ) {}

    public function index(): JsonResponse
    {
        return ClientResource::collection(
            $this->clientService->list()
        )->response();
    }

    public function show(Client $client): JsonResponse
    {
        return ClientResource::make($client)->response();
    }

    public function store(ClientRequest $clientRequest): JsonResponse
    {
        $validated = $clientRequest->safe()->toArray();

        /** @var Client $createdClient */
        $createdClient = DB::transaction(
            fn() => $this->clientService->store(
                ClientDto::fromArray($validated)
            )
        );

        return ClientResource::make($createdClient)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(
        Client $client,
        ClientRequest $clientRequest
    ): JsonResponse
    {
        $clientDto = ClientDto::fromArray(
            $clientRequest->safe()->toArray()
        );

        /** @var Client $updatedClient */
        $updatedClient = DB::transaction(
            fn() => $this->clientService->update(
                $client,
                $clientDto
            )
        );

        return ClientResource::make($updatedClient)
            ->response();
    }

    public function destroy(Client $client): JsonResponse
    {
        $client->delete();

        return response()->json(
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}
