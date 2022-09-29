<x-oix-modal title="{{ __('Add component') }}" size="modal-lg">


    <div>
        <p>
            {{ __('Click on any component in the list below to add it to the content of your page') }}
        </p>
        <div class="row gutters-tiny">
            @foreach($creatablePluginForms as $pluginForm)
                <div class="col-sm-3">
                    <a class="card w-100 p-20 text-black-50 text-center text-capitalize font-weight-bold border-primary mb-2 bg-white"
                            href="javascript:void(0)"
                            wire:click="createComponent({{ $pluginForm->id }})">
                        <div class="text-center">
                            {{ $pluginForm->name }}
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>

    <x-slot:actions>

        <button wire:click="$emit('closeModal')" type="button" class="btn btn-secondary" aria-label="Close">
            {{ __('Close') }}
        </button>
    </x-slot:actions>
</x-oix-modal>