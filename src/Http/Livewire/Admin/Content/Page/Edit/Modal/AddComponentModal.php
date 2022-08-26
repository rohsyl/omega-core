<?php

namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Page\Edit\Modal;

use rohsyl\OmegaCore\Extensions\Livewire\Modal\ModalComponent;
use rohsyl\OmegaCore\Models\Page;

class AddComponentModal extends ModalComponent
{
    public $page;

    public function mount(Page $page) {
        $this->page = $page;
    }

    public function render() {
        return view('omega::livewire.admin.content.page.edit.modal.add-component-modal');
    }
}