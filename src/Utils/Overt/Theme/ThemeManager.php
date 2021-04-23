<?php


namespace rohsyl\OmegaCore\Utils\Overt\Theme;

use Illuminate\Support\Facades\View;
use rohsyl\OmegaCore\ServiceProvider;
use Omega\Utils\Path;

class ThemeManager
{
    private $installerPath;
    private $themePath;

    public function setInstallerPath(string $installerPath) {

        $this->installerPath = $installerPath;
    }

    public function setThemePath(string $path) {
        $this->themePath = $path;
    }

    public function boot(ServiceProvider $provider) {

        // Add a namespace to access theme views
        View::addNamespace('theme', $this->themePath);

        // register publish current theme assets
        $provider->publishes([
            $this->themePath . DIRECTORY_SEPARATOR . 'assets' => public_path('theme'),
        ], 'theme');
    }

    /**
     * @return mixed
     */
    public function getThemePath()
    {
        return $this->themePath;
    }
}