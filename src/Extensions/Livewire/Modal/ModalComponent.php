<?php

namespace rohsyl\OmegaCore\Extensions\Livewire\Modal;

class ModalComponent extends \LivewireUI\Modal\ModalComponent
{
    protected static array $maxWidths = [
        'modal-lg' => 'modal-lg',
        'modal-xl' => 'modal-xl',
    ];

    public static function modalMaxWidth(): string
    {
        return 'modal-lg';
    }
}