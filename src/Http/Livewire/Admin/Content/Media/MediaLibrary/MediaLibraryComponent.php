<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary;

use Illuminate\Support\Str;
use Livewire\Component as LivewireComponent;
use rohsyl\OmegaCore\Models\Media;

class MediaLibraryComponent extends LivewireComponent
{
    protected $listeners = ['fileUploaded', 'fileUploadCancelled', 'selectMedia'];

    public $directory = null;

    protected $queryString = [
        'directory' => ['except' => null]
    ];

    public $media = null;

    public $selectedMedia = null;
    public $selecteds = [];


    protected $rules = [
        'selectedMedia.name' => 'sometimes|required|string|not_in:ROOT,PUBLIC',
        'selectedMedia.title' => 'required|string',
        'selectedMedia.description' => 'nullable|string',
    ];

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

    public function selectMedia($media_id = null, $ctrlPressed = false) {
        if(!$ctrlPressed) {
            $this->selecteds = [];
        }
        if(isset($media_id)) {
            $this->selecteds[$media_id] = isset($this->selecteds[$media_id]) ? !$this->selecteds[$media_id] : true;
        }
        if($ctrlPressed) {
            if(isset($this->selectedMedia) && $this->selectedMedia->id == $media_id) {
                $this->selectedMedia = null;
            }
            return;
        }

        $this->closeCreateDirectoryForm();
        $this->closeUploadForm();
        $this->closeEditForm();


        if(!isset($media_id)) {
            $this->selectedMedia = null;
        }

        if(isset($media_id) && isset($this->selectedMedia) && $this->selectedMedia->id === $media_id) {
            $this->selectedMedia = null;
            unset($this->selecteds[$media_id]);
        }
        else {
            $this->selectedMedia = Media::find($media_id);
        }

        //$this->dispatchBrowserEvent('omega-media-selected', ['media' => isset($this->selectedMedia) ? $this->selectedMedia->toArray() : null]);
    }

    public function home() {
        $this->loadDirectory(null);
    }

    public $showUploadForm = false;
    public function showUploadForm() {
        $this->selectMedia(null);
        $this->closeCreateDirectoryForm();
        $this->closeEditForm();
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
        $this->closeEditForm();
        $this->showCreateDirectoryForm = true;
    }
    public function createDirectory() {
        $inputs = $this->validate([
            'directory_name' => 'required|string|not_in:ROOT,PUBLIC',
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

    public $showEditForm = false;
    public function showEditForm() {
        $this->closeUploadForm();
        $this->closeCreateDirectoryForm();
        $this->showEditForm = true;
    }
    public function editMedia() {
        $inputs = $this->validate(null, null, [
            'selectedMedia.name',
            'selectedMedia.title',
            'selectedMedia.description',
        ]);

        $inputs['selectedMedia']['name'] = Str::slug($inputs['selectedMedia']['name'], '_');

        $this->selectedMedia->update($inputs['selectedMedia']);
        $this->closeEditForm();
        $this->refresh();
    }
    public function closeEditForm() {
        $this->showEditForm = false;
    }
}