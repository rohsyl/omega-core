<?php


namespace rohsyl\OmegaCore\Utils\Overt\Facades;


use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Models\Locale;
use rohsyl\OmegaCore\Utils\Overt\EntityManager;
use rohsyl\OmegaCore\Utils\Overt\Menu\MenuManager;
use rohsyl\OmegaCore\Utils\Overt\Site\SiteManager;

/**
 * Class Entity
 * @package rohsyl\OmegaCore\Utils\Common\Facades
 *
 * @method static void setSite(SiteManager $site)
 * @method static void setPage(\rohsyl\OmegaCore\Models\Page $page)
 * @method static void setMenu(MenuManager $menu)
 * @method static void setLocale(Locale $locale)
 * @method static void setLocaleSlug(string $langSlug)
 * @method static MenuManager Menu()
 * @method static \rohsyl\OmegaCore\Models\Page Page()
 * @method static SiteManager Site()
 * @method static Locale Locale()
 *
 * @see EntityManager
 */
class Entity extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:entity';
    }
}