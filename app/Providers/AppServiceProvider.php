<?php

namespace App\Providers;
use Auth;
use App\Models\GeneralSettings;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

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

         Paginator::useBootstrap();
         $settings = GeneralSettings::first();
         view()->share('settings', $settings);
    }
}
