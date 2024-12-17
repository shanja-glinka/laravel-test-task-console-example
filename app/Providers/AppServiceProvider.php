<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Contracts\UserRepositoryInterface::class, \App\Repositories\User\UserRepository::class);
        $this->app->bind(\App\Repositories\Contracts\UserBalanceRepositoryInterface::class, \App\Repositories\User\UserBalanceRepository::class);
        $this->app->bind(\App\Repositories\Contracts\UserOperationRepositoryInterface::class, \App\Repositories\User\UserOperationRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
