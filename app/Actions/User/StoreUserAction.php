<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Dto\UserDto;
use App\Models\User;

final class StoreUserAction
{
    public function __invoke(UserDto $userDto): User
    {
        return User::query()->create([
            'name'     => $userDto->name,
            'email'    => $userDto->email,
            'password' => $userDto->password,
        ]);
    }
}
