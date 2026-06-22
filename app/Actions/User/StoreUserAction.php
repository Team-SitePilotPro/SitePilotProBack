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
            'first_name' => $userDto->firstName,
            'last_name'  => $userDto->lastName,
            'email'      => $userDto->email,
            'phone'      => $userDto->phone,
            'userRole'   => $userDto->userRole,
            'password'   => $userDto->password,
        ]);
    }
}
