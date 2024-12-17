<?php

namespace App\Repositories\User;

use App\Models\UserBalance;
use App\Repositories\Contracts\UserBalanceRepositoryInterface;

class UserBalanceRepository implements UserBalanceRepositoryInterface
{
    /**
     * @param int $userId
     * 
     * @return UserBalance
     */
    public function getByUserId(int $userId): UserBalance
    {
        return UserBalance::firstOrCreate(['user_id' => $userId], ['balance' => 0]);
    }

    /**
     * @param int $userId
     * @param float $amount
     * 
     * @return bool
     */
    public function updateBalance(int $userId, float $amount): bool
    {
        $balance = $this->getByUserId($userId);
        $balance->balance = $amount;

        return $balance->save();
    }
}
