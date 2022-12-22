<?php


namespace rohsyl\OmegaCore\Http\Livewire\Admin\Content\Media\MediaLibrary;


use Livewire\Component as LivewireComponent;
use Livewire\WithFileUploads;
use rohsyl\OmegaCore\Models\Media;

class FileUploaderComponent extends LivewireComponent
{
    use WithFileUploads;

    public $media;

    public $files = [];

    protected $listeners = ['save'];

    public function render() {

        return view('omega::livewire.admin.content.media.medialibrary.uploader');
    }

    public function save()
    {
        $this->validate([
            'files.*' => 'file',
        ]);

        foreach ($this->files as $file) {

            $filename = $file->getClientOriginalName();
            $name = pathinfo($filename)['filename'];

            $media = Media::create([
                'parent_id' => $this->media->id,
                'owner_id' => auth()->id(),
                'type' => Media::TYPE_FILE,
                'name' => $name,
                'title' => $name,
            ]);

            $path_dir = 'medialibrary/' . $media->id;
            $path = $path_dir . '/' . $filename;

            $media->update([
                'ext' => $file->extension(),
                'path' => $path
            ]);


            $file->storeAs($path_dir, $filename);
        }

        $this->files = [];
        $this->emitUp('fileUploaded');
    }

    public function cancel() {
        $this->files = [];
        $this->emitUp('fileUploadCancelled');
    }
}