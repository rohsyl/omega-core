<?php


namespace rohsyl\OmegaCore\Utils\Common\Plugin;


use rohsyl\OmegaCore\Utils\Common\Facades\OmegaUtils;
use rohsyl\OmegaCore\Utils\Common\Plugin\Type\TypeManager;

class PluginManager
{
    /**
     * @var array
     */
    private $plugins;

    private $installedPlugins;

    private TypeManager $typeManager;

    public function __construct()
    {
        $this->plugins = [];
        $this->loadInstalledPlugins();
        $this->typeManager = new TypeManager();
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

    public function register(Plugin $plugin) {
        $this->plugins[$plugin->name()] = $plugin;
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

    public function types() {
        return $this->typeManager;
    }
}