<?php

namespace App\Providers;

use App\Interfaces\ColorRepositoryInterface;
use App\Interfaces\HiladoRepositoryInterface;
use App\Interfaces\HiladosproveedorRepositoryInterface;
use App\Interfaces\ProveedorRepositoryInterface;
use App\Interfaces\TipofibraRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ColorRepository;
use App\Repositories\HiladoRepository;
use App\Repositories\HiladosproveedorRepository;
use App\Repositories\ProveedorRepository;
use App\Repositories\TipofibraRepository;
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

        // Para registrar el repositorio de hiladosproveedor en el contenedor de servicios de Laravel
        $this->app->bind(
            HiladosproveedorRepositoryInterface::class,
            HiladosproveedorRepository::class
        );

        // Para registrar el repositorio de tipofibra en el contenedor de servicios de Laravel
        $this->app->bind(
            TipofibraRepositoryInterface::class,
            TipofibraRepository::class
        );

        // Para registrar el repositorio de color en el contenedor de servicios de Laravel
        $this->app->bind(
            ColorRepositoryInterface::class,
            ColorRepository::class
        );

        $this->app->bind(
            ProveedorRepositoryInterface::class,
            ProveedorRepository::class
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
