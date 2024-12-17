<?php

namespace App\Jobs;

use App\Enums\UserOperationTypeEnum;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\BalanceService;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ProcessOperation implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $userId,
        private string $type,
        private float $amount,
        private string $description
    ) {}


    /**
     * Execute the job.
     */
    public function handle(
        BalanceService $balanceService
    ) {
        match ($this->type) {
            UserOperationTypeEnum::deposit->value => $balanceService->charge($this->userId, $this->amount, $this->description),
            UserOperationTypeEnum::withdrawal->value => $balanceService->chargeOff($this->userId, $this->amount, $this->description),
            default => throw new \Exception('Type must be ' . UserOperationTypeEnum::deposit->value . ' or ' . UserOperationTypeEnum::withdrawal->value),
        };
    }
}
