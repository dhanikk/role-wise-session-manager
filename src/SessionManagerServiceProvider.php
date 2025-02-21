<?php

namespace Itpathsolutions\Sessionmanager;

use Illuminate\Support\ServiceProvider;
use Itpathsolutions\Sessionmanager\Http\Middleware\RoleBasedSessionMiddleware;
use Itpathsolutions\Sessionmanager\Http\Middleware\CheckAdminRole;
use Itpathsolutions\Sessionmanager\Http\Commands\RemoveMigrationCommand;
use Illuminate\Routing\Router;

class SessionManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Load package routes
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');

        // Load package views
        $this->loadViewsFrom(__DIR__.'/resources/views', 'sessionmanager');

        // Load migrations from the package
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        // Publish migrations to the main Laravel project
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'migrations');

        // Register artisan command if running in the console
        if ($this->app->runningInConsole()) {
            $this->commands([
                RemoveMigrationCommand::class,
            ]);
        }
    }
}
