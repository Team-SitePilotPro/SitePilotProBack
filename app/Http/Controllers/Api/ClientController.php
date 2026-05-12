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
    /// Constructeur avec injection de dépendance du service ClientService.
    public function __construct(
        private readonly ClientService $clientService,
    ) {}

    /// Retourne la liste de tous les clients.
    public function index(): JsonResponse
    {
        return ClientResource::collection(
            $this->clientService->list()
        )->response();
    }

    /// Affiche les détails d'un client spécifique.
    public function show(Client $client): JsonResponse
    {
        return ClientResource::make($client)->response();
    }

    /// Crée un nouveau client.
    public function store(ClientRequest $clientRequest): JsonResponse
    {
        $validated = $clientRequest->safe()->toArray();

        /** @var Client $createdClient */
        $createdClient = DB::transaction(
            fn() => $this->clientService->store(
                ClientDto::fromArray($validated)
            )
        );

        // Retourne le client créé avec un code de statut 201 (Created).
        return ClientResource::make($createdClient)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /// Met à jour un client existant.
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

    /// Supprime un client.
    public function destroy(Client $client): JsonResponse
    {
        $client->delete();

        return response()->json(
            null,
            Response::HTTP_NO_CONTENT
        );
    }
}