<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\MELI\MELItokenRepository;
use App\Interfaces\MELI\MELItokenRepositoryInterface;

use App\Interfaces\MELI\MELIUserRepositoryInterface;
use App\Repositories\MELI\MELIuserRepository;

use App\Interfaces\TokenRepositoryInterface;
use App\Repositories\TokenRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {   
        // MELI api
        $this->app->bind(MELItokenRepositoryInterface::class, MELItokenRepository::class);
        $this->app->bind(MELIUserRepositoryInterface::class, MELIuserRepository::class);

        // DataBase
        $this->app->bind(TokenRepositoryInterface::class, TokenRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}