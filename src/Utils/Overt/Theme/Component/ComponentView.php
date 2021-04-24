<?php


namespace rohsyl\OmegaCore\Utils\Overt\Theme\Component;


use Omega\Utils\Path;

class ComponentView
{
    private $pluginName;
    private $viewName;
    private $versionString;
    private $newView;
    private $label;


    public function __construct($pluginName, $viewName, $versionString, $newView, $label){
        $this->pluginName = $pluginName;
        $this->viewName = $viewName;
        $this->versionString = $versionString;
        $this->newView = $newView;
        $this->label = $label;
    }

    /**
     * @return string
     */
    public function getPluginName()
    {
        return $this->pluginName;
    }

    /**
     * @return string
     */
    public function getViewName()
    {
        return $this->viewName;
    }

    /**
     * @return string
     */
    public function getVersionString()
    {
        return $this->versionString;
    }

    /**
     * @return string
     */
    public function getNewView()
    {
        return $this->newView;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }
}