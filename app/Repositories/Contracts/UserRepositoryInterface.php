<?php

namespace App\Repositories\Contracts;

use App\Http\Dto\UserDto;
use App\Models\User;

interface UserRepositoryInterface
{
    /**
     * @param string $email
     * 
     * @return User|null
     */
    public function findByEmail(string $email): ?User;

    /**
     * @param UserDto $dto
     * 
     * @return User
     */
    public function create(UserDto $dto): User;

    /**
     * @param int $id
     * 
     * @return User|null
     */
    public function findById(int $id): ?User;
}
