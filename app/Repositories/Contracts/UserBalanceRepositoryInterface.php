<?php

namespace App\Repositories\Contracts;

use App\Models\UserBalance;

interface UserBalanceRepositoryInterface
{
    /**
     * @param int $userId
     * 
     * @return UserBalance
     */
    public function getByUserId(int $userId): UserBalance;

    /**
     * @param int $userId
     * @param float $amount
     * 
     * @return bool
     */
    public function updateBalance(int $userId, float $amount): bool;
}
