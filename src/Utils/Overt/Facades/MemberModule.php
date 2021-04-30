<?php


namespace rohsyl\OmegaCore\Utils\Overt\Facades;


use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Modules\Member\Locale\MemberLocaleManager;
use rohsyl\OmegaCore\Modules\Member\MemberManager;
use rohsyl\OmegaCore\Utils\Overt\Page\PageManager;

/**
 * Class Page
 * @package rohsyl\OmegaCore\Utils\Common\Facades
 *
 * @method static string getLoginRedirectUrl()
 * @method static string getLogoutRedirectUrl()
 * @method static string getTemplateModel()
 * @method static MemberLocaleManager getLocaleManager()
 * @method static void setLoginRedirectUrl(string $url)
 * @method static void setLogoutRedirectUrl(string $url)
 * @method static void setTemplateModel(string $model)
 *
 * @see MemberManager
 */
class MemberModule extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:member';
    }
}