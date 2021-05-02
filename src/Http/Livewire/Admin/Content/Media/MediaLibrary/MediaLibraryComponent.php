<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary;

use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\Media;

class MediaLibraryComponent extends LivewireComponent
{
    public $directory = null;

    protected $queryString = [
        'directory' => ['except' => null]
    ];

    public $media = null;

    public $selectedMedia = null;
    public $selecteds = [];

    public function mount() {
        $this->loadDirectory();
    }

    public function init() {

    }

    public function render() {

        return view('omega::livewire.admin.content.media.medialibrary.index');
    }

    private function loadDirectory($media_id = null) {

        if(isset($media_id)) {
            $this->directory = $media_id;
        }

        if($this->directory == null) {
            $this->media = Media::query()
                ->with('children')
                ->where('is_system', true)
                ->whereNull('parent_id')
                ->where('name', Media::ROOT_DIRECTORY)
                ->first();

            if(!isset($this->media)) {
                throw new \Exception('Error: No ROOT directory set. TODO.');
            }

        }
        else {
            $this->media = Media::query()
                ->with('children')
                ->find($this->directory);

            if(!isset($this->media)) {
                throw new \Exception('Directory not found');
            }
        }

        $this->selectedMedia = null;
    }

    public function openMedia($media_id) {
        $this->loadDirectory($media_id);
    }

    public function selectMedia($media_id) {

        if(!isset($media_id)) {
            $this->selectedMedia = null;
        }

        $this->selectedMedia = Media::find($media_id);
    }

    public function home() {
        $this->loadDirectory(null);
    }
}