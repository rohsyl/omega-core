<div class="row">
    <div class="col-md-6">
        <div class="row">
            @forelse($widgetAreas as $widgetArea)
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between">
                                <div>
                                    {{ \Illuminate\Support\Str::title($widgetArea->name) }}
                                </div>
                                <div>
                                    <button type="button" class="btn btn-sm btn-outline-dark" wire:click="showAddWidgetForm({{ $widgetArea->id }})"><i class="fas fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            @forelse($widgetArea->component_widget_areas as $component_widget_area)
                                <div class="d-flex justify-content-between border-bottom py-2">
                                    <div>
                                        {{ $component_widget_area->component->name }}
                                    </div>
                                    <div>
                                        <a type="button" href="javascript:void()" wire:click="showEditWidgetForm({{ $component_widget_area->component->id }})"><i class="fas fa-edit"></i></a>
                                        &nbsp;
                                        <a type="button" href="javascript:void()" class="text-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            @empty
                                <p class="mb-0">{{ __('No widget...') }}</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            @empty
                <div class="col">
                    <p>{{ __('No widgetarea...') }}</p>
                </div>
            @endforelse
        </div>
    </div>
    <div class="col-md-6">

        @if($showAddWidgetForm)
            <div class="card">
                <div class="card-body">

                    <h4>{{ __('Add widget') }}</h4>
                    <p>
                        {{ __('Add a widget to an area') }}
                    </p>

                    <div class="form-group">
                        {{ Form::label('widget_plugin_form_id', __('Widget')) }}
                        {{ Form::oselect('widget_plugin_form_id', $creatableWidgetPluginForms, $widget_plugin_form_id, ['wire:model.defer' => 'widget_plugin_form_id', 'wire:target' => 'createWidget', 'wire:loading.attr' => 'readonly', 'placeholder' => 'Choose a widget', 'class' => 'form-control', 'no-js' => true]) }}
                    </div>
                    {{ Form::otext('widget_name', $widget_name, ['label' => __('Name'), 'wire:model.defer' => 'widget_name', 'wire:target' => 'createWidget', 'wire:loading.attr' => 'readonly']) }}

                    <div class="mt-4 text-right">
                        <button class="btn btn-primary btn-sm"
                                type="button"
                                wire:click="createWidget"
                                wire:target="createWidget"
                                wire:loading.attr="disabled">
                            <i class="fas fa-plus"></i>
                            {{ __('Create') }}
                        </button>
                        <button class="btn btn-outline-secondary btn-sm"
                                type="button"
                                wire:click="hideAddWidgetForm"
                                wire:target="hideAddWidgetForm"
                                wire:loading.attr="disabled"
                        >
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        @endif

        @if($showEditWidgetForm)
            <div class="card">
                <div class="card-body">


                    <h4>{{ __('Update') }}</h4>
                    <p>
                        {{ __('Add a widget to an area') }}
                    </p>


                    <div class="mt-4 text-right">
                        <button class="btn btn-primary btn-sm"
                                type="button"
                                wire:click="updateWidget"
                                wire:target="updateWidget"
                                wire:loading.attr="disabled">
                            <i class="fas fa-save"></i>
                            {{ __('Update') }}
                        </button>
                        <button class="btn btn-outline-secondary btn-sm"
                                type="button"
                                wire:click="hideEditWidgetForm"
                                wire:target="hideEditWidgetForm"
                                wire:loading.attr="disabled"
                        >
                            {{ __('Cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        @endif

    </div>
</div>