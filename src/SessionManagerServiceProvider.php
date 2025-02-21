<?php

namespace Itpathsolutions\Sessionmanager;

use Illuminate\Support\ServiceProvider;

class SessionManagerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'sessionmanager');
        $this->loadMigrationsFrom(database_path('migrations'));
        $this->publishes([
            __DIR__.'/database/migrations/' => database_path('migrations'),
        ], 'migrations');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Itpathsolutions\Sessionmanager\Http\Commands\RemoveMigrationCommand::class,
            ]);
        }
    }

}
