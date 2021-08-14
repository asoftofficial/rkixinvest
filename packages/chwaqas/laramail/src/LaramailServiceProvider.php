<?php

namespace Chwaqas\Laramail;

use Chwaqas\Laramail\Command\VendorPublishCommand;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class LaramailServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        Route::middlewareGroup('laramail', config('laramail.middlewares', []));

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laramail');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laramail');
        $this->registerRoutes();

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register the package routes.
     *
     * @return void
     */
    private function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__.'/Http/routes.php');
        });
    }

    /**
     * Get the Telescope route group configuration array.
     *
     * @return array
     */
    private function routeConfiguration()
    {
        return [
            'namespace' => 'Chwaqas\Laramail\Http\Controllers',
            'prefix' => config('laramail.path'),
            'middleware' => 'laramail',
        ];
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laramail.php', 'laramail');

        // Register the service the package provides.
        $this->app->singleton('laramail', function ($app) {
            return new LaramailServiceProvider;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laramail'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laramail.php' => config_path('laramail.php'),
        ], 'laramail.config');

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/laramail'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../resources/views/templates' => $this->app->resourcePath('views/vendor/laramail/templates'),
        ], 'laramail.templates');

        // Add Artisan publish command
        $this->commands([
            VendorPublishCommand::class,
        ]);
    }
}
