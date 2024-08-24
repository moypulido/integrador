<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\MELI\MELItokenRepository;
use App\Interfaces\MELI\MELItokenRepositoryInterface;
use App\Interfaces\MELI\MELIUserRepositoryInterface;
use App\Repositories\MELI\MELIuserRepository;
use App\Interfaces\MELI\MELIOrdersRepositoryInterface;
use App\Repositories\MELI\MELIOrdersRepository;
use App\Interfaces\MELI\MELIPacksRepositoryInterface;
use App\Repositories\MELI\MELIPacksRepository;
use App\Interfaces\MELI\MELIShipmentsRepositoryInterface;
use App\Repositories\MELI\MELIShipmentsRepository;
use App\Interfaces\MELI\MELISitesRepositoryInterface;
use App\Repositories\MELI\MELISitesRepository;

use App\Interfaces\TokenRepositoryInterface;
use App\Repositories\TokenRepository;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\UserRepository;

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
        $this->app->bind(MELIOrdersRepositoryInterface::class, MELIOrdersRepository::class);
        $this->app->bind(MELIPacksRepositoryInterface::class, MELIPacksRepository::class);
        $this->app->bind(MELIShipmentsRepositoryInterface::class, MELIShipmentsRepository::class);
        $this->app->bind(MELISitesRepositoryInterface::class, MELISitesRepository::class);

        // DataBase
        $this->app->bind(TokenRepositoryInterface::class, TokenRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
