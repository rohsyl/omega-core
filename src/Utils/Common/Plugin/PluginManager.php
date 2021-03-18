<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin;


class PluginManager
{
    /**
     * @var array
     */
    private $plugins;

    public function __construct()
    {
        $this->plugins = [];
    }

    public function register($name, $plugin) {
        $this->plugins[$name] = $plugin;
    }

    public function all() {
        return $this->plugins;
    }

    public function get($name) {
        return $this->plugins[$name] ?? null;
    }
}