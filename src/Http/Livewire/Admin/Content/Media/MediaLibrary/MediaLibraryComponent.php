<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary;

use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\Media;

class MediaLibraryComponent extends LivewireComponent
{
    protected $listeners = [
        'fileUploaded',
        'fileUploadCancelled',
        'selectMedia',
        'medialibrary:refresh' => 'refresh',
    ];

    public $directory_id = null;
    public $directory = null;

    protected $queryString = [
        'directory_id' => ['except' => null]
    ];

    public function mount() {
        $this->loadDirectory($this->directory_id);
    }

    public function init() {

    }

    public function render() {

        return view('omega::livewire.admin.content.media.medialibrary.index');
    }

    public function refresh() {
        $this->loadDirectory($this->directory->id);
    }

    public function back() {
        if(isset($this->directory)) {
            $parent = $this->directory->parent;
            if(isset($parent)) {
                $this->loadDirectory($parent->id);
            }
        }
    }

    private function loadDirectory($media_id = null) {

        if(isset($media_id)) {
            $this->directory = Media::query()
                ->with(['children'])
                ->find($media_id);

            if(!isset($this->directory)) {
                throw new \Exception('Directory not found');
            }
        }
        else {
            $this->directory = Media::query()
                ->with('children')
                ->where('is_system', true)
                ->whereNull('parent_id')
                ->where('name', Media::ROOT_DIRECTORY)
                ->first();

            if(!isset($this->directory)) {
                throw new \Exception('Error: No ROOT directory set. TODO.');
            }
        }
        $this->directory_id = $this->directory->id;
    }

    public function openMedia($media_id) {
        $media = Media::find($media_id);
        if ($media->type == Media::TYPE_DIRECTORY) {
            $this->loadDirectory($media_id);
        }
    }

    public function home() {
        $this->loadDirectory(null);
    }

    public function fileUploaded() {
        $this->refresh();
    }

    public function deleteFile($selectedMediaId) {
        Media::find($selectedMediaId)->delete();
        $this->refresh();
    }
}