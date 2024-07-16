<?php

namespace App\Providers;

use App\Interfaces\HiladoRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\HiladoRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);


        // Para registrar el repositorio de hilado en el contenedor de servicios de Laravel
        $this->app->bind(
            HiladoRepositoryInterface::class,
            HiladoRepository::class
        );
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
