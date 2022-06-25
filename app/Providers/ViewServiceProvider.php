<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Profile\Service\Facade\Profile;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function($view) {
            $view->with('usersPaginated', Profile::profiles(10));
        });
        View::composer('*', function($view)
        {
            $view->with('viewRouteName', Route::currentRouteName());
        });
    }
}
