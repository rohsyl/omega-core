<?php

namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary\Modal;

use Illuminate\Support\Str;
use rohsyl\OmegaCore\Extensions\Livewire\Modal\ModalComponent;
use rohsyl\OmegaCore\Models\Media;

class EditMediaModal extends ModalComponent
{
    public $media;

    protected $rules = [
        'media.name' => 'sometimes|required|string|not_in:ROOT,PUBLIC',
        'media.title' => 'required|string',
        'media.description' => 'nullable|string',
    ];

    public function mount(Media $media) {
        $this->media = $media;
    }

    public function render() {
        return view('omega::livewire.admin.content.media.medialibrary.modal.edit-media-modal');
    }

    public function editMedia() {
        $inputs = $this->validate(null, null, [
            'media.name',
            'media.title',
            'media.description',
        ]);

        $inputs['media']['name'] = Str::slug($inputs['media']['name'], '_');

        $this->media->update($inputs['media']);
        $this->emit('medialibrary:refresh');
        $this->closeModal();
    }
}