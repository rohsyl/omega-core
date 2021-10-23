<?php


namespace rohsyl\OmegaCore\Utils\Overt\Theme;

use Illuminate\Support\Facades\View;
use rohsyl\OmegaCore\ServiceProvider;
use Omega\Utils\Path;
use rohsyl\OmegaCore\Utils\Common\Widget\WidgetAreaManager;

class ThemeManager
{
    private $installerPath;
    private $functionPath;
    private $registerPath;
    private $themePath;

    private $widgetAreaManager;

    public function __construct()
    {
        $this->widgetAreaManager = new WidgetAreaManager($this);
    }

    public function setInstallerPath(string $installerPath) {

        $this->installerPath = $installerPath;
    }

    public function setFunctionPath(string $functionPath) {

        $this->functionPath = $functionPath;
    }

    public function setTemplateRegisterPath(string $registerPath) {

        $this->registerPath = $registerPath;
    }

    public function setThemePath(string $path) {
        $this->themePath = $path;
    }

    public function boot(ServiceProvider $provider) {

        if(isset($this->functionPath)) {
            $this->includeFunctionFile();
        }

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

    public function getFunctionPath() {
        return $this->themePath . DIRECTORY_SEPARATOR . $this->functionPath;
    }

    /**
     * @return string
     */
    public function getRegisterPath()
    {
        return $this->themePath . DIRECTORY_SEPARATOR . $this->registerPath;
    }

    public function getRegister() {
        $path = $this->getRegisterPath();
        if(!file_exists($path)){
            return null;
        }
        return include($path);
    }

    public function getInstaller() {
        $path = $this->getInstallerPath();
        if(!file_exists($path)){
            return null;
        }
        return include($path);
    }

    public function includeFunctionFile() {
        $path = $this->getFunctionPath();
        if(!file_exists($path)){
            return null;
        }
        return include($path);
    }

    public function getThemeTemplate() {

        $files = array();
        $themeFolder = $this->getThemePath();
        $directory_path = $themeFolder . DIRECTORY_SEPARATOR . 'template';
        if(file_exists($directory_path)){
            $dir = opendir ($directory_path);
            while($element = readdir($dir))
            {
                if($element != '.' && $element != '..' && $element != 'register.php')
                {
                    if (!is_dir($directory_path . DIRECTORY_SEPARATOR . $element))
                        $files[$element] = ucfirst(without_ext(without_ext($element)));
                }
            }
            //sort($files);
        }


        return $files;
    }

    public function getName() {
        return $this->getRegister()->getName();
    }

    public function get() {
        return $this;
    }

    /**
     * @return WidgetAreaManager
     */
    public function widgetArea() {
        return $this->widgetAreaManager;
    }
}