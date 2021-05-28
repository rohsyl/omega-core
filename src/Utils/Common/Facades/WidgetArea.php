<?php


namespace rohsyl\OmegaCore\Utils\Common\Facades;


use Illuminate\Support\Facades\Facade;

class WidgetArea extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'omega:widgetarea';
    }
}