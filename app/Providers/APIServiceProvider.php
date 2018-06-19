<?php

namespace API\Providers;

use Illuminate\Support\ServiceProvider;
use API\User;

class APIServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('model.user', User::class);
    }
}
