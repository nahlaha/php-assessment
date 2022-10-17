<?php

declare(strict_types=1);

namespace App\Repositories;

use App\Dtos\User\CreateUserDto;
use App\Dtos\User\UpdateUserDto;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepo;

/**
 * Class UserRepository
 * @package App\Repositories
 */
final class UserRepository implements IUserRepo
{

    public function __construct(private User $user)
    {
    }

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User|null
    {
        return $this->user->where('email', $email)->first();
    }

    /**
     * @param int $id
     * @return User
     */
    public function getUserById(int $id): User|null
    {
        return $this->user->where('id', $id)->first();
    }

    /**
     * Creates a new user
     * @param CreateUserDto $createUserDto
     * @return User
     */
    public function createUser(CreateUserDto $createUserDto): User
    {
        $this->user->first_name = $createUserDto->firstName;
        $this->user->last_name = $createUserDto->lastName;
        $this->user->email = $createUserDto->email;
        $this->user->password = $createUserDto->password;
        $this->user->role_id = $createUserDto->roleId;
        $this->user->save();
        return $this->user;
    }

    /**
     * delete a user
     */
    public function deleteUser(int $id): bool|null
    {
        return $this->user->query()->find($id)->delete();
    }

    public function UpdateUser(UpdateUserDto $updateUserDto): bool
    {
        $this->user->where('id', $updateUserDto->id);
        if (!is_null($updateUserDto->firstName)) {
            $this->user->first_name = $updateUserDto->firstName;
        }
        if (!is_null($updateUserDto->lastName)) {
            $this->user->last_name = $updateUserDto->lastName;
        }
        if (!is_null($updateUserDto->email)) {
            $this->user->email = $updateUserDto->email;
        }
        if (!is_null($updateUserDto->roleId)) {
            $this->user->role_id = $updateUserDto->roleId;
        }
        return $this->user->save();
    }
}
