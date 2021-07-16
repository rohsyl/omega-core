<div class="card">
    <div class="card-body">
        <h4>{{ __('Edit') }} {{ \Illuminate\Support\Str::title($component->plugin_form->plugin->name) }}'s {{ __('settings') }}</h4>
        <p>
            {{ __('Here you can configure your component\'s settings...') }}
        </p>


        {{ Form::otext('compId', null, ['wire:model.defer' => 'compId', 'label' => __('Component ID'), 'helper' => __('Set the #id of the component\'s section.')]) }}
        {{ Form::otext('compTitle', null, ['wire:model.defer' => 'compTitle', 'label' => __('Component Title'), 'helper' => __('A title for the component.')]) }}
        <div class="form-group">
            <label for="compTemplate">{{ __('Component Title') }}</label>
            <select wire:model.defer="compTemplate" id="compTemplate" class="form-control">
                @foreach($componentTemplates as $value => $label)
                    <option value="{{ $value }}" wire:key="{{ $value}}">{{ $label }}</option>
                @endforeach
            </select>
            <span class="text-muted small">
                {{ __('Choose the template for this component') }}
            </span>
        </div>
        {{ Form::ocheckbox('isHidden', null, ['wire:model.defer' => 'isHidden', 'label' => __('Hide the component')]) }}
        <div class="form-group">
            <label for="compWidth">{{ __('Component width') }}</label>
            <select wire:model.defer="compWidth" id="compWidth" class="form-control">
                @foreach($componentWidths as $value => $label)
                    <option value="{{ $value }}" wire:key="{{ $value}}">{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div class="mt-4 text-right">
            <button class="btn btn-outline-primary btn-sm"
                    type="button"
                    wire:click="saveSettings"
                    wire:target="saveSettings"
                    wire:loading.attr="disabled"
            >
                {{ __('Save') }}
            </button>
            <button class="btn btn-outline-secondary btn-sm"
                    type="button"
                    wire:click="cancelSettings"
                    wire:target="cancelSettings"
                    wire:loading.attr="disabled"
            >
                {{ __('Cancel') }}
            </button>
        </div>
    </div>
</div>