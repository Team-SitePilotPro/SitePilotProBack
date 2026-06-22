<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Dto\UserDto;
use App\Models\User;

final class UpdateUserAction
{
    public function __invoke(User $user, UserDto $userDto): User
    {
        $data = [
            'first_name' => $userDto->firstName,
            'last_name'  => $userDto->lastName,
            'email'      => $userDto->email,
            'phone'      => $userDto->phone,
            'userRole'   => $userDto->userRole,
        ];

        if ($userDto->password !== null) {
            $data['password'] = $userDto->password;
        }

        $user->update($data);

        return $user->refresh();
    }
}
