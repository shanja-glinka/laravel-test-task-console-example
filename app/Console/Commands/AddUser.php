<?php

namespace App\Console\Commands;

use App\Http\Dto\UserDto;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class AddUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:add-user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @param UserRepositoryInterface $users
     */
    public function __construct(private UserRepositoryInterface $users)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = $this->users->create(new UserDto(
            name: $this->argument('name'),
            email: $this->argument('email'),
            password: Hash::make($this->argument('password')),
        ));

        $this->info("User created with ID: {$user->id}");
    }
}
