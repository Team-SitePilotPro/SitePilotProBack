<?php

declare(strict_types=1);

namespace App\Services;

use App\Actions\User\StoreUserAction;
use App\Actions\User\UpdateUserAction;
use App\Dto\UserDto;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        private readonly StoreUserAction $storeUserAction,
        private readonly UpdateUserAction $updateUserAction,
    ) {}

    public function list(): Collection
    {
        return User::query()->latest()->get();
    }

    public function store(UserDto $userDto): User
    {
        return ($this->storeUserAction)($userDto);
    }

    public function update(User $user, UserDto $userDto): User
    {
        return ($this->updateUserAction)($user, $userDto);
    }
}
