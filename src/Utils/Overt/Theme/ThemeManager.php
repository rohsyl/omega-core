<?php


namespace rohsyl\OmegaCore\Utils\Overt\Theme;

use Illuminate\Support\Facades\View;

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

    public function register() {

        View::addNamespace('theme', $this->themePath);
    }

    /**
     * @return mixed
     */
    public function getThemePath()
    {
        return $this->themePath;
    }
}