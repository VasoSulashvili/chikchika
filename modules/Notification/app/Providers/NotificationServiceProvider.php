<?php

namespace Notification\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Notification\Service\NotificationService;


class NotificationServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('NotificationService', function($app){
            return new NotificationService();
        });

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        Route::middleware('web')
                ->group(base_path('modules/Notification/routes/web.php'));
        $this->loadMigrationsFrom(__DIR__. '/../../database/migrations');
    }
}