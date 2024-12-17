<?php

namespace App\Repositories\User;

use App\Http\Dto\UserDto;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    /**
     * @param string $email
     * 
     * @return User|null
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param UserDto $dto
     * 
     * @return User
     */
    public function create(UserDto $dto): User
    {
        return User::create($dto->toArray());
    }

    /**
     * @param int $id
     * 
     * @return User|null
     */
    public function findById(int $id): ?User
    {
        return User::find($id);
    }
}
