<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary;

use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\Media;

class MediaLibraryComponent extends LivewireComponent
{
    protected $listeners = ['fileUploaded', 'fileUploadCancelled'];

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

    public function refresh() {
        $this->loadDirectory($this->directory);
        $this->selectMedia(null);
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
        $media = Media::find($media_id);
        if ($media->type == Media::TYPE_DIRECTORY) {
            $this->loadDirectory($media_id);
        }
    }

    public function selectMedia($media_id = null) {
        $this->closeCreateDirectoryForm();
        $this->closeUploadForm();
        if(!isset($media_id)) {
            $this->selectedMedia = null;
        }

        $this->selectedMedia = Media::find($media_id);
    }

    public function home() {
        $this->loadDirectory(null);
    }

    public $showUploadForm = false;
    public function showUploadForm() {
        $this->selectMedia(null);
        $this->closeCreateDirectoryForm();
        $this->showUploadForm = true;
    }
    public function closeUploadForm() {
        $this->showUploadForm = false;
    }
    public function fileUploaded() {
        $this->closeUploadForm();
        $this->refresh();
    }
    public function fileUploadCancelled() {
        $this->closeUploadForm();
    }

    public function deleteFile() {
        $this->selectedMedia->delete();
        $this->refresh();
    }

    public $showCreateDirectoryForm = false;
    public $directory_name;
    public function showCreateDirectoryForm() {
        $this->selectMedia(null);
        $this->closeUploadForm();
        $this->showCreateDirectoryForm = true;
    }
    public function createDirectory() {
        $inputs = $this->validate([
            'directory_name' => 'required|string',
        ]);

        Media::create([
            'parent_id' => $this->media->id,
            'owner_id' => auth()->id(),
            'type' => Media::TYPE_DIRECTORY,
            'name' => $inputs['directory_name'],
            'title' => $inputs['directory_name'],
        ]);

        $this->closeCreateDirectoryForm();
        $this->directory_name = null;
        $this->refresh();
    }
    public function closeCreateDirectoryForm() {
        $this->showCreateDirectoryForm = false;
    }
}