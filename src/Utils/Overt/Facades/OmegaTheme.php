<?php
namespace rohsyl\OmegaCore\Utils\Overt\Facades;


use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\ServiceProvider;
use rohsyl\OmegaCore\Utils\Overt\Theme\Component\Template;
use rohsyl\OmegaCore\Utils\Overt\Theme\Installer\Installer;
use rohsyl\OmegaCore\Utils\Overt\Theme\ThemeManager;

/**
 * Class OmegaTheme
 * @package rohsyl\OmegaCore\Utils\Overt\Facades
 *
 * @method static void setInstallerPath($path)
 * @method static void setTemplateRegisterPath($path)
 * @method static void setThemePath($path)
 * @method static void boot(ServiceProvider $provider)
 * @method static string getThemePath()
 * @method static string getInstallerPath()
 * @method static string getRegisterPath()
 * @method static Template getRegister()
 * @method static Installer getInstaller()
 * @method static array getThemeTemplate()
 * @method static string getName()
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