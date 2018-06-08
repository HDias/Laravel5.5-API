<?php

namespace Sendler\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;

class SendlerServiceProvider extends ServiceProvider
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
