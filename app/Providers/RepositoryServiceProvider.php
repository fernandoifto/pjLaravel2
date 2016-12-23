<?php

namespace pjLaravel\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\pjLaravel\Repositories\ClientRepository::class, \pjLaravel\Repositories\ClientRepositoryEloquent::class);
        $this->app->bind(\pjLaravel\Repositories\ProjectRepository::class, \pjLaravel\Repositories\ProjectRepositoryEloquent::class);
        $this->app->bind(\pjLaravel\Repositories\ProjectNoteRepository::class, \pjLaravel\Repositories\ProjectNoteRepositoryEloquent::class);
        $this->app->bind(\pjLaravel\Repositories\ProjectTaskRepository::class, \pjLaravel\Repositories\ProjectTaskRepositoryEloquent::class);
        //:end-bindings:
    }
}
