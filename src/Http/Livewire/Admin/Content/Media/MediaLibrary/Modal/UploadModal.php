<?php

namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\Modal;

use rohsyl\OmegaCore\Extensions\Livewire\Modal\ModalComponent;
use rohsyl\OmegaCore\Models\Media;

class UploadModal extends ModalComponent
{
    public $directory;

    protected $listeners = [
        'fileUploaded',
    ];

    public function mount(Media $directory) {
        $this->directory = $directory;
    }

    public function render() {
        return view('omega::livewire.admin.content.media.medialibrary.modal.upload-modal');
    }

    public function fileUploaded() {
        $this->emit('medialibrary:refresh');
        $this->closeModal();
    }
}