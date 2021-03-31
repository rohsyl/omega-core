<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin;


use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;

class PluginManager
{
    /**
     * @var array
     */
    private $plugins;

    private $installedPlugins;

    public function __construct()
    {
        $this->plugins = [];
        $this->loadInstalledPlugins();
    }

    private function loadInstalledPlugins() {
        if(!OmegaUtils::isInstalled()) return;

        $plugins = \rohsyl\OmegaCore\Models\Plugin::query()
            ->get();
        $this->installedPlugins = [];
        foreach($plugins as $plugin) {
            $this->installedPlugins[$plugin->name] = $plugin;
        }
    }

    public function register($name, $plugin) {
        $this->plugins[$name] = $plugin;
    }

    public function all() {
        return $this->plugins;
    }

    public function getPlugin($name) {
        return $this->plugins[$name] ?? null;
    }

    public function getModel($name, $force = false) {
        return $this->installedPlugins[$name]
            ?? ($force)
                ? \rohsyl\OmegaCore\Models\Plugin::query()->where('name', $name)->first()
                : null;
    }
}