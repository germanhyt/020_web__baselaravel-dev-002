<?php

namespace App\Providers;

use App\Interfaces\HiladoRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Repositories\HiladoRepository;
use App\Repositories\StudentRepository;
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


        $this->app->bind(StudentRepositoryInterface::class, StudentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
