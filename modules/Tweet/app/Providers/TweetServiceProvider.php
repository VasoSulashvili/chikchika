<?php

namespace Tweet\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Tweet\Service\TweetService;


class TweetServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('TweetService', function($app){
            return new TweetService();
        });

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        Route::middleware('web')
                ->group(base_path('modules/Tweet/routes/web.php'));
        $this->loadMigrationsFrom(__DIR__. '/../../database/migrations');

    }
}