<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MELI\tokenRepository;
use App\Interfaces\MELI\tokenRepositoryInterface;

use App\Interfaces\MELI\UserRepositoryInterface;
use App\Repositories\MELI\userRepository;

class MELIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(tokenRepositoryInterface::class, tokenRepository::class);
        $this->app->bind(UserRepositoryInterface::class, userRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
