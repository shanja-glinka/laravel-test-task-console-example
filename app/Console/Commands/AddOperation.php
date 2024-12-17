<?php

namespace App\Console\Commands;

use App\Enums\UserOperationTypeEnum;
use App\Jobs\ProcessOperation;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Console\Command;

class AddOperation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-operation {email} {type} {amount} {description?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @param UserRepositoryInterface $users
     */
    public function __construct(
        private UserRepositoryInterface $users,
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email');
        $type = $this->argument('type');
        $amount = (float) $this->argument('amount');
        $description = $this->argument('description') ?? null;

        $user = $this->users->findByEmail($email);

        if (!$user) {
            $this->error("User not found by email: $email");
            return 1;
        }

        if (!in_array($type, [UserOperationTypeEnum::deposit->value, UserOperationTypeEnum::withdrawal->value])) {
            $this->error('Type must be ' . UserOperationTypeEnum::deposit->value . ' or ' . UserOperationTypeEnum::withdrawal->value);
            return 1;
        }

        if (!is_numeric($amount) || (float)$amount <= 0) {
            $this->error("Amount must be a positive number. Given: $amount");
            return 1;
        }

        $amount = (float)$amount;

        ProcessOperation::dispatch($user->id, $type, $amount, $description);

        $this->info("Operation queued successfully. Type: $type, Amount: $amount, Description: '$description'");

        return 0;
    }
}
