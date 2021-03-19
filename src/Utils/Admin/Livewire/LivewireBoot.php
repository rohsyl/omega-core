<?php


namespace rohsyl\OmegaCore\Utils\Admin\Livewire;


use Livewire\Livewire;
use rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\EditPageComponent;

class LivewireBoot
{

    public static function boot() {

        Livewire::component('omega_edit-page', EditPageComponent::class);
    }
}