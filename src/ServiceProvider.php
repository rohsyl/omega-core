<?php
namespace rohsyl\OmegaCore;

use Illuminate\Support\ServiceProvider as SP;

class ServiceProvider extends SP
{

    public function register() {
        $this->mergeConfigFrom(
            __DIR__.'/../config/omega.php', 'omega'
        );
    }

    public function boot() {

        if ($this->app->runningInConsole()) {
            $this->commands([
                // register here omega command
            ]);
        }

        $this->publishes([
            __DIR__.'/../config/omega.php' => config_path('omega.php'),
        ]);

        $this->publishes([
            __DIR__.'/../resources/views' => resource_path('views/vendor/omega'),
        ]);

        $this->publishes([
            __DIR__.'/../public' => public_path('vendor/omega'),
        ], 'public');

        // load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // load migrations
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        // load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'omega');
    }
}