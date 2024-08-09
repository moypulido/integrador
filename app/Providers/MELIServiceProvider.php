<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\MELI\tokenRepository;
use App\Interfaces\MELI\tokenRepositoryInterface;

class MELIServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(tokenRepositoryInterface::class, tokenRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
