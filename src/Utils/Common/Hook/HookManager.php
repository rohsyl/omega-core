<?php
namespace rohsyl\OmegaCore\Utils\Common\Hook;

class HookManager
{

    private $hooks;



    public function __construct()
    {
        $this->hooks = [];
    }

    public function addAction(string $hook, callable $callback, string $tag = null, int $priority = 10) {

        if(isset($tag)) {
            $this->hooks[$hook][$priority][$tag] = $callback;
        }
        else {
            $this->hooks[$hook][$priority][] = $callback;
        }
    }

    public function removeAction(string $hook, string $tag) {
        foreach($this->hooks[$hook] as $priority) {
            if(isset($priority[$tag])) {
                unset($priority[$tag]);
                return true;
            }
        }
        return false;
    }

    public function callActions($hook, ...$args) {
        $priorites = $this->hooks[$hook];

        $out = [];
        foreach($priorites as $callback) {
            if(is_callable($callback)) {
                $out[] = call_user_func_array($callback, $args);
            }
        }
        return $out;
    }
}