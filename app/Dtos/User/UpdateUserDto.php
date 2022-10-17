<?php

declare(strict_types=1);

namespace App\Dtos\User;

final class UpdateUserDto
{

    public function __construct(
        public int $id,
        public ?string $firstName,
        public ?string $lastName,
        public ?string $email,
        public ?int $roleId
    ) {
    }
}
