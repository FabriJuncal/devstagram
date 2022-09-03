<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Validamos si nos encontramos en el entorno de producción
        if($this->app->environment('production'))
        {
            // Forzamos a que todas las direcciones de URL se sirvan con "HTTPS"
            URL::forceScheme('https');
        }
    }
}
