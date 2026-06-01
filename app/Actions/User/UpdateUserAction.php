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
            'name'  => $userDto->name,
            'email' => $userDto->email,
        ];

        if ($userDto->password !== null) {
            $data['password'] = $userDto->password;
        }

        $user->update($data);

        return $user->refresh();
    }
}
