<x-oix-modal title="{{ __('Upload') }}" size="modal-xl">



    <livewire:omega_media-fileuploader :media="$directory"/>

    <x-slot:actions>

        <button wire:click="$emitTo('omega_media-fileuploader', 'save')"
                type="button" class="btn btn-primary">
            <i class="fas fa-check"></i>
            {{ __('Confirm') }}
        </button>
        <button wire:click="$emit('closeModal')"
                type="button" class="btn btn-secondary" aria-label="Close">
            {{ __('Close') }}
        </button>
    </x-slot:actions>
</x-oix-modal>