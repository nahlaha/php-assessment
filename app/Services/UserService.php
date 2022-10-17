<?php

declare(strict_types=1);

namespace App\Services;

use App\Constants\Error;
use App\Dtos\User\CreateUserDto;
use App\Dtos\User\UpdateUserDto;
use App\Exceptions\ApplicationException;
use App\Models\User;
use App\Repositories\Interfaces\IUserRepo;
use App\Services\Interfaces\IUserService;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserService
 * @package App\Services
 */
final class UserService implements IUserService
{

    public function __construct(private IUserRepo $userRepository)
    {
    }

    /**
     * @param string $email
     * @return User
     */
    public function getUserByEmail(string $email): User|null
    {
        return  $this->userRepository->getUserByEmail($email);
    }

    /**
     * @return User
     */
    public function getUserById(int $id): User|null
    {
        $user = $this->userRepository->getUserById($id);
        if (is_null($user)) {
            throw new ApplicationException(Error::USER_NOT_FOUND->value);
        }
        return  $user;
    }

    /**
     * @param CreateUserDto $createUserDto
     * @return User
     * @throws ApplicationException
     */
    public function createUser(CreateUserDto $createUserDto): User
    {
        $user = $this->getUserByEmail($createUserDto->email);
        if (!is_null($user)) {
            throw new ApplicationException(Error::EMAIL_ALREADY_EXISTS->value);
        }
        $createUserDto->password = Hash::make($createUserDto->password);
        return $this->userRepository->createUser($createUserDto);
    }

    public function updateUser(UpdateUserDto $updateUserDto): bool
    {
        $this->getUserById($updateUserDto->id);
        return $this->userRepository->updateUser($updateUserDto);
    }

    public function deleteUser(int $id): bool|null
    {
        $this->getUserById($id);
        return $this->userRepository->deleteUser($id);
    }
}
