<?php


namespace rohsyl\OmegaCore\Utils\Common\Facades;


use Illuminate\Support\Facades\Facade;

class Page extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'omega:page';
    }
}