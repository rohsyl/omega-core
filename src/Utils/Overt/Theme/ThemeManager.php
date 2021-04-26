<?php


namespace rohsyl\OmegaCore\Utils\Overt\Theme;

use Illuminate\Support\Facades\View;
use rohsyl\OmegaCore\ServiceProvider;
use Omega\Utils\Path;

class ThemeManager
{
    private $installerPath;
    private $registerPath;
    private $themePath;

    public function setInstallerPath(string $installerPath) {

        $this->installerPath = $installerPath;
    }

    public function setTemplateRegisterPath(string $registerPath) {

        $this->registerPath = $registerPath;
    }

    public function setThemePath(string $path) {
        $this->themePath = $path;
    }

    public function boot(ServiceProvider $provider) {

        // Add a namespace to access theme views
        View::addNamespace('theme', $this->themePath);

        // register publish current theme assets
        $provider->publishes([
            $this->getAssetsPath() => public_path('theme'),
        ], 'theme');
    }

    /**
     * @return string
     */
    public function getThemePath()
    {
        return $this->themePath;
    }

    /**
     * @return string
     */
    public function getAssetsPath() {
        return $this->themePath . DIRECTORY_SEPARATOR . 'assets';
    }

    /**
     * @return string
     */
    public function getInstallerPath()
    {
        return $this->themePath . DIRECTORY_SEPARATOR . $this->installerPath;
    }

    /**
     * @return string
     */
    public function getRegisterPath()
    {
        return $this->themePath . DIRECTORY_SEPARATOR . $this->registerPath;
    }
}