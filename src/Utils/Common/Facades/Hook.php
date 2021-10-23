<?php

namespace rohsyl\OmegaCore\Utils\Common\Facades;

use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Utils\Common\Hook\HookManager;

/**
 * @method static void addAction(string $hook, callable $callback, string $tag = null, int $priority = 10)
 * @method static boolean removeAction(string $hook, string $tag)
 * @method static mixed callActions($hook, ...$args)
 *
 * @see HookManager
 */
class Hook extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:hook';
    }
}