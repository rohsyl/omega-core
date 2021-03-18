<?php
namespace rohsyl\OmegaCore\Utils\Common\Facades;

use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Models\User;

/**
 * Class PluginRegister
 *
 * @method static void register(string $name, $plugin)
 * @method static array all()
 * @method static mixed get(string $name)
 *
 * @see rohsyl\OmegaCore\Utils\Common\Plugin\PluginManager
 */
class Plugin extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'omega:plugin';
    }

}