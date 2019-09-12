<?php

namespace IoDigital\HealthCheck;

use Illuminate\Support\ServiceProvider;

class HealthCheckServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes.php');

        $this->publishes([
            __DIR__ . '/config/healthcheck.php' => config_path('healthcheck.php'),
        ]);
    }

    /**
     * Register any package services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/healthcheck.php', 'healthcheck');

        $this->app->bind('iodigital-healthcheck', function () {
            return new HealthCheck();
        });
    }
}
