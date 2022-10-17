<?php

declare(strict_types=1);

namespace App\Dtos\User;

final class CreateUserDto
{

    public function __construct(
        public string $firstName,
        public ?string $lastName,
        public string $email,
        public string $password,
        public int $roleId
    ) {
    }
}
