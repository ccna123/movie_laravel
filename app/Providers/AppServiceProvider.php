<?php

namespace App\Providers;

use App\Services\AdminService;
use App\Services\MovieService;
use App\Services\UserService;
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
        $this->app->singleton(MovieService::class, function ($app) {
            return new MovieService();
        });

        $this->app->singleton(UserService::class, function ($app) {
            return new UserService();
        });

        $this->app->singleton(AdminService::class, function ($app) {
            return new AdminService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
