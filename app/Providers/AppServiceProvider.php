<?php

namespace App\Providers;

//use Illuminate\Routing\UrlGenerator;

use Illuminate\Support\Facades\URL;
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
    // public function boot(UrlGenerator $url)
    public function boot()
    {
        // //asset helper loads http instead of https and in production causes mix content issue
        if($this->app->environment('production')){
            URL::forceScheme('https');
        }

        // if(env('APP_ENV') !== 'local')
        // {
        //     $url->forceSchema('https');
        // }
    }
}
