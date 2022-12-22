<div>

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
                        <td style="width:100px;" class="text-center">
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
    </form>


</div>
