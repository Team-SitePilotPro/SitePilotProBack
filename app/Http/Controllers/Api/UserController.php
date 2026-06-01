<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Dto\UserDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    ) {}

    public function index(): JsonResponse
    {
        return UserResource::collection(
            $this->userService->list()
        )->response();
    }

    public function show(User $user): JsonResponse
    {
        return UserResource::make($user)->response();
    }

    public function store(StoreUserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = DB::transaction(
            fn() => $this->userService->store(
                UserDto::fromArray($request->safe()->toArray())
            )
        );

        return UserResource::make($user)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        /** @var User $updatedUser */
        $updatedUser = DB::transaction(
            fn() => $this->userService->update(
                $user,
                UserDto::fromArray($request->safe()->toArray())
            )
        );

        return UserResource::make($updatedUser)->response();
    }

    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
