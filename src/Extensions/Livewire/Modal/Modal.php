<?php

namespace rohsyl\OmegaCore\Extensions\Livewire\Modal;

use Illuminate\View\View;

class Modal extends \LivewireUI\Modal\Modal
{
    public function render(): View
    {
        if (config('livewire-ui-modal.include_js', true)) {
            $jsPath = base_path().'/vendor/wire-elements/modal/public/modal.js';
        }

        if (config('livewire-ui-modal.include_css', false)) {
            $cssPath = base_path().'/vendor/wire-elements/modal/public/modal.css';
        }

        return view('omega::livewire.laravel-ui-modal.modal', [
            'jsPath' => $jsPath ?? null,
            'cssPath' => $cssPath ?? null,
        ]);
    }
}