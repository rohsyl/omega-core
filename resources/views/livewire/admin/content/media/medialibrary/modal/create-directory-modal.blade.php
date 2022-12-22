<x-oix-modal title="{{ __('Create a directory') }}" size="modal-md">


    <div>
        {{ Form::otext('directory_name', null, ['label' => 'Directory', 'wire:model.defer' => 'directory_name', 'wire:target' => 'createDirectory', 'wire:loading.attr' => 'readonly']) }}
    </div>

    <x-slot:actions>
        <button type="button" class="btn btn-primary"
                wire:click="createDirectory"
                wire:loading.attr="disabled"
                wire:target="createDirectory">
            <span wire:loading wire:target="createDirectory">
                <i class="fas fa-spinner fa-spin"></i>
            </span>
            {{ __('Create') }}
        </button>
        <button wire:click="$emit('closeModal')" type="button" class="btn btn-secondary" aria-label="Close">
            {{ __('Close') }}
        </button>
    </x-slot:actions>
</x-oix-modal>