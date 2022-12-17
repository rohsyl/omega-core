<?php


namespace rohsyl\OmegaCore\Utils\Common\Blade;


use Illuminate\Support\Facades\Blade;

class BladeBoot
{
    public static function boot() {
        Blade::component('omega::common.components.oix.card', 'oix-card');
        Blade::component('omega::common.components.oix.livewire-modal-layout', 'oix-modal');

        Blade::component('omega::common.components.oix.inputs.input-group', 'oix-input-group');

        Blade::component('omega::common.components.oix.inputs.mediachooser', 'oix-input-mediachooser');
        Blade::component('omega::common.components.oix.inputs.text', 'oix-input-text');
        Blade::component('omega::common.components.oix.inputs.richtext', 'oix-input-richtext');
    }
}