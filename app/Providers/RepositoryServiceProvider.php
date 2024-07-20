<?php

namespace App\Providers;

use App\Interfaces\ColorRepositoryInterface;
use App\Interfaces\HiladoRepositoryInterface;
use App\Interfaces\HiladosproveedorRepositoryInterface;
use App\Interfaces\ProveedorRepositoryInterface;
use App\Interfaces\TejidoRepositoryInterface;
use App\Interfaces\TejidosHiladoRepositoryInterface;
use App\Interfaces\TipoacabadoRepositoryInterface;
use App\Interfaces\TipofibraRepositoryInterface;
use App\Interfaces\TipotejidoRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\ColorRepository;
use App\Repositories\HiladoRepository;
use App\Repositories\HiladosproveedorRepository;
use App\Repositories\ProveedorRepository;
use App\Repositories\TejidoRepository;
use App\Repositories\TejidosHiladoRepository;
use App\Repositories\TipoacabadoRepository;
use App\Repositories\TipofibraRepository;
use App\Repositories\TipotejidoRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // BIND ES UNA FUNCION DE LARAVEL QUE PERMITE REGISTRAR UNA CLASE EN EL CONTENEDOR DE SERVICIOS DE LARAVEL
        // BIDN ESPAÑOL SIGNIFICA LIGAR O VINCULAR


        // Para registrar el repositorio de usuario en el contenedor de servicios de Laravel
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

        // Para registrar el repositorio de proveedor en el contenedor de servicios de Laravel
        $this->app->bind(
            ProveedorRepositoryInterface::class,
            ProveedorRepository::class
        );

        // Para registrar el repositorio de tejidos hilado en el contenedor de servicios de Laravel
        $this->app->bind(
            TejidosHiladoRepositoryInterface::class,
            TejidosHiladoRepository::class
        );

        // Para registrar el repositorio de tejido en el contenedor de servicios de Laravel
        $this->app->bind(
            TejidoRepositoryInterface::class,
            TejidoRepository::class
        );

        // Para registrar el repositorio de tipotejido en el contenedor de servicios de Laravel
        $this->app->bind(
            TipotejidoRepositoryInterface::class,
            TipotejidoRepository::class
        );

        // Para registrar el repositorio de tipoacabado en el contenedor de servicios de Laravel
        $this->app->bind(
            TipoacabadoRepositoryInterface::class,
            TipoacabadoRepository::class
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
