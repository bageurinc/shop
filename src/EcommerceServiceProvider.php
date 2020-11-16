<?php

namespace Bageur\Ecommerce;

use Illuminate\Support\ServiceProvider;

class EcommerceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // include __DIR__.'/routes/web.php';
        $this->app->make('Bageur\Ecommerce\ProdukCmsController');
        $this->app->make('Bageur\Ecommerce\OrderCmsController');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/migration');
    }
}
