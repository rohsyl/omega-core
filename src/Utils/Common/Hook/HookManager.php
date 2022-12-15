<?php
namespace rohsyl\OmegaCore\Utils\Common\Hook;

use Illuminate\Support\HtmlString;

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

    public function callActions($hook, ?array $args = null, bool $stringify = false, bool $htmlify = true) {
        $priorites = $this->hooks[$hook];
        $args = isset($args) ? $args : [];

        $out = [];
        foreach($priorites as $callbacks) {
            foreach($callbacks as $callback) {
                if(is_callable($callback)) {
                    $out[] = call_user_func_array($callback, $args) ?? null;
                }
            }
        }
        if($stringify) {
            $out = join('', $out);
            if($htmlify) {
                return new HtmlString($out);
            }
        }
        return $out;
    }
}