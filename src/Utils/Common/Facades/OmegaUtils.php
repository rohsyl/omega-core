<?php
namespace rohsyl\OmegaCore\Utils\Common\Facades;

use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Models\User;

/**
 * @method static string GetCurrentUserAvatar()
 * @method static string GetUserAvatar(User $user)
 * @method static string GetCurrentUserName()
 * @method static string GetCurrentUserFullName()
 * @method static array getInstalledPlugin()
 * @method static string renderMeta()
 * @method static boolean isInstalled()
 * @method static void addDependencies(array $dependencies)
 * @method static string renderDependencies()
 * @method static string renderOmegaAssets()
 *
 * @see \rohsyl\OmegaCore\Utils\Common\OmegaUtils
 */
class OmegaUtils extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:utils';
    }
}