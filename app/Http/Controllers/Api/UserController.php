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

    // Return the list of all users.
    public function index(): JsonResponse
    {
        return UserResource::collection(
            $this->userService->list()
        )->response();
    }

    // Return the details of a specific user.
    public function show(User $user): JsonResponse
    {
        return UserResource::make($user)->response();
    }

    // Create a new user.
    public function store(StoreUserRequest $request): JsonResponse
    {
        /** @var User $user */
        $user = DB::transaction(
            fn () => $this->userService->store(
                UserDto::fromArray($request->safe()->toArray())
            )
        );

        return UserResource::make($user)
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    // Update an existing user — merge existing values so partial updates work.
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = array_merge([
            'first_name' => $user->first_name,
            'last_name'  => $user->last_name,
            'email'      => $user->email,
            'phone'      => $user->phone,
            'userRole'   => $user->userRole,
        ], $request->safe()->toArray());

        /** @var User $updatedUser */
        $updatedUser = DB::transaction(
            fn () => $this->userService->update($user, UserDto::fromArray($data))
        );

        return UserResource::make($updatedUser)->response();
    }

    // Soft-delete a user.
    public function destroy(User $user): JsonResponse
    {
        $user->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
