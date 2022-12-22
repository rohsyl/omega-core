<x-oix-modal title="{{ __('Edit media') }}" size="modal-xl">

    <div class="row">
        <div class="col-sm-4">
            @if($media->type == \rohsyl\OmegaCore\Models\Media::TYPE_FILE)
            <div class="mt-4" >
                <p class="mb-1 font-weight-bold">{{ __('Preview') }}</p>
                <div>

                </div>
                @if($media->media_type == \rohsyl\OmegaCore\Models\Media::MT_PICTURE)
                    <a href="{{ $media->url }}" target="_blank">
                        <img src="{{ $media->url }}" style="max-height: 200px"/>
                    </a>
                @else
                    <a href="{{ $media->url }}" target="_blank">
                        <i class="fa fa-external-link-alt"></i>
                        {{ __('View file') }}
                    </a>
                @endif
            </div>
            @endif
        </div>
        <div class="col-sm-8">
            {{ Form::otext('media.name', $media->name, ['label' => 'Name', 'wire:model.defer' => 'media.name', 'wire:target' => 'editMedia', 'wire:loading.attr' => 'readonly']) }}
            {{ Form::otext('media.title', $media->title, ['label' => 'Title', 'wire:model.defer' => 'media.title', 'wire:target' => 'editMedia', 'wire:loading.attr' => 'readonly']) }}
            {{ Form::otext('media.description', $media->description, ['label' => 'Description', 'wire:model.defer' => 'media.description', 'wire:target' => 'editMedia', 'wire:loading.attr' => 'readonly']) }}
        </div>
    </div>

    <x-slot:actions>

        <button type="button" class="btn btn-primary"
                wire:click="editMedia"
                wire:loading.attr="disabled"
                wire:target="editMedia">
            <span wire:loading wire:target="editMedia">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
            {{ __('Update') }}
        </button>
        <button wire:click="$emit('closeModal')"
                type="button" class="btn btn-secondary" aria-label="Close">
            {{ __('Close') }}
        </button>
    </x-slot:actions>
</x-oix-modal>