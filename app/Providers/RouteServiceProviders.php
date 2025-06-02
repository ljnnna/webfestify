<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RouteServiceProviders extends ServiceProvider
{
    /**
     * Register services.
     */
    public const HOME = '/home';

    public function register(): void
    {
    
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
