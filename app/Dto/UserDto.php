<?php

declare(strict_types=1);

namespace App\Dto;

use App\Enums\UserRole;

class UserDto
{
    public function __construct(
        public readonly string $firstName,
        public readonly string $lastName,
        public readonly string $email,
        public readonly string $phone,
        public readonly UserRole $userRole,
        public readonly ?string $password,
    ) {}

    /**
     * @param array<string,mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            firstName: $data['first_name'],
            lastName:  $data['last_name'],
            email:     $data['email'],
            phone:     $data['phone'],
            userRole:  $data['userRole'] instanceof UserRole
                ? $data['userRole']
                : UserRole::from($data['userRole']),
            password:  $data['password'] ?? null,
        );
    }
}
