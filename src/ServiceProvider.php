<?php
namespace rohsyl\OmegaCore;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as SP;
use rohsyl\OmegaCore\Http\Middleware\AdminLocale;
use rohsyl\OmegaCore\Http\Middleware\OmegaIsInstalled;
use rohsyl\OmegaCore\Http\Middleware\OmegaLoadConfiguration;
use rohsyl\OmegaCore\Http\Middleware\OmegaLoadEntity;
use rohsyl\OmegaCore\Http\Middleware\OmegaNotInstalled;
use rohsyl\OmegaCore\Utils\Admin\Form\FormBoot;
use rohsyl\OmegaCore\Utils\Common\OmegaUtils;
use rohsyl\OmegaCore\Utils\Common\Entity\OmegaConfig;
use rohsyl\OmegaCore\Utils\Common\Plugin\PluginManager;

class ServiceProvider extends SP
{

    public const DASHBOARD = '/admin/dashboard';
    public const LOGIN = '/admin/login';

    public function register() {
        $this->mergeConfigFrom(
            __DIR__.'/../config/omega.php', 'omega'
        );

        $this->registerFacades();
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

        Blade::componentNamespace('rohsyl\\OmegaCore\\Views\\Components', 'omega');
        FormBoot::boot();

        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('om_not_installed', OmegaNotInstalled::class);
        $router->aliasMiddleware('om_is_installed', OmegaIsInstalled::class);
        $router->aliasMiddleware('om_admin_locale', AdminLocale::class);
        $router->aliasMiddleware('om_load_config', OmegaLoadConfiguration::class);
        $router->aliasMiddleware('om_load_entity', OmegaLoadEntity::class);
    }

    private function registerFacades() {

        $this->app->bind('omega:config', function () {
            return new OmegaConfig();
        });

        $this->app->bind('omega:utils', function () {
            return new OmegaUtils();
        });

        $this->app->bind('omega:plugin', function () {
            return new PluginManager();
        });
    }
}