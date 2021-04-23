<?php
namespace rohsyl\OmegaCore\Utils\Overt\Facades;


use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Utils\Overt\Theme\ThemeManager;

/**
 * Class OmegaTheme
 * @package rohsyl\OmegaCore\Utils\Overt\Facades
 *
 * @method static void setInstallerPath($path)
 * @method static void setThemePath($path)
 * @method static void register()
 * @method static string getThemePath()
 *
 * @see ThemeManager
 */
class OmegaTheme extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:theme';
    }
}