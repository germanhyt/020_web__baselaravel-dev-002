<?php

namespace App\Providers;

use App\Interfaces\HiladoRepositoryInterface;
use Illuminate\Routing\UrlGenerator;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // En caso de que no se usen recursos de la base de datos, se puede comentar la siguiente línea
        $this->app->register(\L5Swagger\L5SwaggerServiceProvider::class);



        // Para registrar el repositorio de hilado en el contenedor de servicios de Laravel
        $this->app->bind(
            HiladoRepositoryInterface::class,
            \App\Repositories\HiladoRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(UrlGenerator $url)
    {
        //
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));


        if (env('APP_ENV') == 'production') {
            $url->forceScheme('https');
        }
    }
}
