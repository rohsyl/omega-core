<?php


namespace rohsyl\OmegaCore\Utils\Common\Blade;


use Illuminate\Support\Facades\Blade;

class BladeBoot
{
    public static function boot() {
        Blade::component('omega::common.components.oix.card', 'oix-card');
    }
}