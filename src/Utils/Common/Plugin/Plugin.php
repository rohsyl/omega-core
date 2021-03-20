<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin;


use rohsyl\OmegaCore\Utils\Common\Plugin\Form\PluginFormFactory;
use rohsyl\OmegaCore\Utils\Common\Plugin\Form\Renderer\PluginFormRenderer;

abstract class Plugin
{
    /**
     * @var null|PluginFormRenderer
     */
    private $formRendererComponent = null;

    public function install() : bool {
        return true;
    }

    public function uninstall() : bool {
        return true;
    }

    abstract function name() : string;

    public function makeForm($callback) {
        $builder = new PluginFormFactory($this->name());
        call_user_func_array($callback, [$builder]);
        $builder->make();
    }

    public function getId() {
        $model = \rohsyl\OmegaCore\Utils\Common\Facades\Plugin::getModel($this->name());
        return isset($model) ? $model->id : null;
    }

    public function isInstalled() {
        return $this->getId() !== null;
    }

    public function getFormRendererComponent() {
        return $this->formRendererComponent;
    }

    /**
     * @param PluginFormRenderer $formRendererComponent
     */
    public function setFormRendererComponent(PluginFormRenderer $formRendererComponent)
    {
        $this->formRendererComponent = $formRendererComponent;
    }
}