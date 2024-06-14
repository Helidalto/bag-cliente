<?php

namespace Helidalto\BagCliente\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * Class BagClienteServiceProvider
 * @package Helidalto\BagCliente\Providers
 */
class BagClienteServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->mergeConfigFrom(
            dirname(__DIR__) . '/Config/system.php', 'core'
        );

        $this->app->register(EventServiceProvider::class);

        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'brcustomer');

        $this->loadJSONTranslationsFrom(__DIR__ . '/../Resources/lang');

        $this->loadMigrationsFrom(__DIR__ .'/../Database/Migrations');
    }
}
