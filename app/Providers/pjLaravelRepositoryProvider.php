<?php

namespace pjLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class pjLaravelRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
                \pjLaravel\Repositories\ClientRepository::class,
                \pjLaravel\Repositories\ClientRepositoryEloquent::class
        );
    }
}
