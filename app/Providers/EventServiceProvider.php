<?php

namespace App\Providers;

use App\Events\createOrderEvent;
use App\Listeners\GenerateInvoiceListener;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * The event listener mappings for the application.
     * @var array
     */
    protected $liteners = [
        createOrderEvent::class => [
            GenerateInvoiceListener::class
        ]
    ];


    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
