<?php


namespace rohsyl\OmegaCore\Utils\Overt\Facades;


use Illuminate\Support\Facades\Facade;
use rohsyl\OmegaCore\Utils\Overt\Page\PageManager;

/**
 * Class Page
 * @package rohsyl\OmegaCore\Utils\Common\Facades
 *
 * @method static PageManager get()
 * @method static PageManager register()
 *
 * @see PageManager
 */
class Page extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:page';
    }
}