<?php

namespace App\Services;

use App\Enums\UserOperationTypeEnum;
use App\Http\Dto\UserOperationDto;
use App\Repositories\Contracts\UserBalanceRepositoryInterface;
use App\Repositories\Contracts\UserOperationRepositoryInterface;

class BalanceService
{
    public function __construct(
        private UserBalanceRepositoryInterface $balanceRepository,
        private UserOperationRepositoryInterface $operationRepository
    ) {}

    /**
     * @param int $userId
     * @param float $amount
     * @param ?string $description
     * 
     * @return bool
     */
    public function charge(int $userId, float $amount, ?string $description): bool
    {
        $balance = $this->balanceRepository->getByUserId($userId);

        $this->balanceRepository->updateBalance($userId, $balance->balance + $amount);

        $this->operationRepository->create(new UserOperationDto(
            userId: $userId,
            amount: $amount,
            operationType: UserOperationTypeEnum::deposit->value,
            description: $description,
        ));

        return true;
    }

    /**
     * @param int $userId
     * @param float $amount
     * @param ?string $description
     * 
     * @return bool
     */
    public function chargeOff(int $userId, float $amount, ?string $description): bool
    {
        $balance = $this->balanceRepository->getByUserId($userId);

        if ($balance->balance < $amount) {
            throw new \Exception('Insufficient funds.');
        }

        $this->balanceRepository->updateBalance($userId, $balance->balance - $amount);

        $this->operationRepository->create(new UserOperationDto(
            userId: $userId,
            amount: $amount,
            operationType: UserOperationTypeEnum::withdrawal->value,
            description: $description ?? null,
        ));

        return true;
    }
}
