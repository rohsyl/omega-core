<?php
namespace rohsyl\OmegaCore;

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider as SP;
use rohsyl\LaravelAcl\ServiceProvider as LaravelAclServiceProvider;
use rohsyl\OmegaCore\Utils\Common\Command\VendorPublishCommand;
use rohsyl\OmegaCore\Utils\Common\Widget\WidgetAreaManager;
use rohsyl\OmegaPlugin\Bundle\ServiceProvider as PluginsBundleServiceProvider;
use rohsyl\OmegaCore\Http\Middleware\AdminLocale;
use rohsyl\OmegaCore\Http\Middleware\OmegaIsInstalled;
use rohsyl\OmegaCore\Http\Middleware\OmegaLoadConfiguration;
use rohsyl\OmegaCore\Http\Middleware\OmegaLoadEntity;
use rohsyl\OmegaCore\Http\Middleware\OmegaNotInstalled;
use rohsyl\OmegaCore\Http\Middleware\Overt\Modules\Member\Authenticate;
use rohsyl\OmegaCore\Modules\Member\MemberBoot;
use rohsyl\OmegaCore\Modules\Member\MemberManager;
use rohsyl\OmegaCore\Utils\Admin\Form\FormBoot;
use rohsyl\OmegaCore\Utils\Admin\Livewire\LivewireBoot;
use rohsyl\OmegaCore\Utils\Common\Blade\BladeBoot;
use rohsyl\OmegaCore\Utils\Common\OmegaUtils;
use rohsyl\OmegaCore\Utils\Common\Entity\OmegaConfig;
use rohsyl\OmegaCore\Utils\Common\Plugin\Commands\PluginInstallCommand;
use rohsyl\OmegaCore\Utils\Common\Plugin\PluginManager;
use rohsyl\OmegaCore\Utils\Common\Theme\Command\InstallThemeCommand;
use rohsyl\OmegaCore\Utils\Common\Theme\Command\PublishThemeCommand;
use rohsyl\OmegaCore\Utils\Overt\EntityManager;
use rohsyl\OmegaCore\Utils\Overt\Facades\OmegaTheme;
use rohsyl\OmegaCore\Utils\Overt\Page\PageManager;
use rohsyl\OmegaCore\Utils\Overt\Theme\ThemeManager;

class ServiceProvider extends SP
{
    public const DASHBOARD = '/admin/dashboard';
    public const LOGIN = '/admin/login';

    public function boot() {

        if ($this->app->runningInConsole()) {
            // command only callable in console
            $this->commands([
            ]);
        }
        // command callable in console and web
        $this->commands([
            VendorPublishCommand::class,
            PluginInstallCommand::class,
            PublishThemeCommand::class,
            InstallThemeCommand::class,
        ]);


        $this->publishes([
            __DIR__.'/../config/omega.php' => config_path('omega.php'),
            __DIR__.'/../config/acl.php' => config_path('acl.php'),
            __DIR__.'/../config/acl/members.php' => config_path('acl/members.php'),
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

        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'omega');


        Blade::componentNamespace('rohsyl\\OmegaCore\\Views\\Components', 'omega');

        FormBoot::boot();
        LivewireBoot::boot();
        BladeBoot::boot();
        OmegaTheme::boot($this);
        MemberBoot::boot($this);


        $router = $this->app->make(Router::class);
        $router->aliasMiddleware('om_not_installed', OmegaNotInstalled::class);
        $router->aliasMiddleware('om_is_installed', OmegaIsInstalled::class);
        $router->aliasMiddleware('om_admin_locale', AdminLocale::class);
        $router->aliasMiddleware('om_load_config', OmegaLoadConfiguration::class);
        $router->aliasMiddleware('om_load_entity', OmegaLoadEntity::class);
        $router->aliasMiddleware('auth_member', Authenticate::class);

    }


    public function register() {
        $this->mergeConfigFrom(
            __DIR__.'/../config/omega.php', 'omega'
        );
        $this->mergeConfigFrom(
            __DIR__.'/../config/acl/users.php', 'acl.users'
        );

        $this->registerFacades();

        $this->app->register(PluginsBundleServiceProvider::class);
        $this->app->register(LaravelAclServiceProvider::class);
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

        $this->app->bind('omega:theme', function () {
            return new ThemeManager();
        });

        $this->app->bind('omega:page', function () {
            return new PageManager();
        });

        $this->app->bind('omega:entity', function () {
            return new EntityManager();
        });

        $this->app->bind('omega:member', function () {
            return new MemberManager();
        });

        $this->app->bind('omega:widgetarea', function () {
            return new WidgetAreaManager();
        });
    }

    public function publishes(array $paths, $groups = null) {
        parent::publishes($paths, $groups);
    }
}