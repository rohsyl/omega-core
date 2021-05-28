<?php


namespace rohsyl\OmegaCore\Utils\Overt\Theme\Component;

class Template
{
    private $name;
    private $componentsView = [];

    public static function For($name){
        return new Template($name);
    }

    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Register a component template view
     * @param $pluginName string The name of the plugin
     * @param $viewName string The name of the view in the plugin view directory (the name without the extentions)
     * @param $versionString string The version of the plugin when this components template was created. It's used to keep track of plugin update and then to alert the developper.
     * @param $newView string The path to the components template view. Relative path from the "template" directory in the theme directory. Without extention.
     * @return $this
     */
    public function registerComponentTemplateView($pluginName, $viewName, $versionString, $newView, $label = null){
        $this->componentsView[$pluginName][$viewName][$newView] = new ComponentView($pluginName, $viewName, $versionString, $newView, $label);
        return $this;
    }

    /**
     * @return array
     */
    public function getAllComponentsView(): array
    {
        return $this->componentsView;
    }

    /**
     * @return array
     */
    public function getAllComponentsViewForPlugin($pluginName): array
    {
        if(isset($this->componentsView[$pluginName]))
            return $this->componentsView[$pluginName];
        else
            return [];
    }

    public function getComponentView($pluginName, $viewName, $newViewPath){
        return $this->componentsView[$pluginName][$viewName][$newViewPath];
    }

}