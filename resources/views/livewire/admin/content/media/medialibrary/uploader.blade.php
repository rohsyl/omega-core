<div>

    <div class="d-flex justify-content-between">
        <div>
            <i class="fas fa-upload"></i>
            {{ __('File upload') }}
        </div>
        <a href="#" wire:click="cancel" class="btn btn-link btn-sm p-0 m-0">
            <i class="fas fa-times"></i>
        </a>
    </div>
    <hr />

    <form wire:submit.prevent="save">
        <input type="file" wire:model="files" multiple>

        @error('files.*') <span class="error">{{ $message }}</span> @enderror


        <div wire:loading wire:target="files" class="mt-4">
            <i class="fas fa-spinner fa-spin"></i> {{ __('Uploading...') }}
        </div>

        @if(sizeof($files) > 0)
            <table class="table table-hover table-sm  mt-4">
                @foreach($files as $file)
                    <tr>
                        <td width="30" class="text-center">
                            @if(media_type_by_ext($file->extension()) == \rohsyl\OmegaCore\Models\Media::MT_PICTURE)
                                <img src="{{ $file->temporaryUrl() }}" alt="{{ $file->getClientOriginalName() }}" class="w-100">
                            @else
                                <i class="fas fa-file"></i>
                            @endif
                        </td>
                        <td class="text-muted">
                            {{ $file->getClientOriginalName() }}
                        </td>
                    </tr>
                @endforeach
            </table>
        @endif


        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-upload"></i>
                {{ __('Upload') }}
            </button>
            <button type="button" class="btn btn-outline-secondary" wire:click="cancel">{{ __('Cancel') }}</button>
        </div>
    </form>


</div>
