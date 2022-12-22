<?php

namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\Modal;

use rohsyl\OmegaCore\Extensions\Livewire\Modal\ModalComponent;
use rohsyl\OmegaCore\Models\Media;

class CreateDirectoryModal extends ModalComponent
{
    public $directory;

    public $directory_name;

    public function mount(Media $directory) {
        $this->directory = $directory;
    }

    public function render() {
        return view('omega::livewire.admin.content.media.medialibrary.modal.create-directory-modal');
    }

    public function createDirectory() {
        $inputs = $this->validate([
            'directory_name' => 'required|string|not_in:ROOT,PUBLIC',
        ]);

        Media::create([
            'parent_id' => $this->directory->id,
            'owner_id' => auth()->id(),
            'type' => Media::TYPE_DIRECTORY,
            'name' => $inputs['directory_name'],
            'title' => $inputs['directory_name'],
        ]);

        $this->directory_name = null;

        $this->emit('medialibrary:refresh');
        $this->closeModal();
    }
}