<?php

namespace Profile\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Profile\Service\ProfileService;
use Illuminate\Support\Facades\Gate;
use Profile\Models\Profile;

class ProfileServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind('ProfileService', function($app){
            return new ProfileService();
        });

    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
        Route::middleware('web')
            ->group(base_path('modules/Profile/routes/web.php'));
        $this->loadMigrationsFrom(__DIR__. '/../../database/migrations');

        Gate::define('update-profile', function (User $user, Profile $profile) {
            return $user->id === $profile->user_id;
        });
    }
}