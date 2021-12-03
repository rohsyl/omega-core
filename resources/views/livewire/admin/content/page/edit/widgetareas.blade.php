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
                        <div class="card-body" id="widgets-container-{{ $widgetArea->id }}">
                            @forelse($widgetArea->component_widget_areas as $component_widget_area)
                                <div class="d-flex justify-content-between border-bottom py-2 widget-item" data-id="{{ $component_widget_area->id }}">
                                    <div>
                                        <span class="grab-sortable" style="cursor:grab;"><i class="fas fa-arrows-alt"></i></span>
                                        {{ $component_widget_area->component->name }}
                                        ({{ $component_widget_area->component->plugin_form->name }})
                                    </div>
                                    <div>
                                        <a type="button" href="javascript:void(0)" wire:click="showEditWidgetForm({{ $component_widget_area->component->id }})"><i class="fas fa-edit"></i></a>
                                        @if(isset($component_widget_area->published_at))
                                            <a type="button"
                                               href="javascript:void(0)"
                                               wire:click="unpublish({{ $component_widget_area->id }})"
                                               class="text-success"
                                               data-toggle="tooltip"
                                               title="Published at {{ $component_widget_area->published_at->format(DATETIMEFORMAT) }}. Click here to unpublish the widget">
                                                <i class="fas fa-globe"></i>
                                            </a>
                                        @else
                                            <a type="button"
                                               href="javascript:void(0)"
                                               wire:click="publish({{ $component_widget_area->id }})"
                                               class="text-muted"
                                               data-toggle="tooltip"
                                               title="Click here to publish the widget">
                                                <i class="fas fa-eye-slash"></i>
                                            </a>
                                        @endif
                                        <a type="button" href="javascript:void(0)" wire:click="deleteWidget({{ $component_widget_area->id }})" class="text-danger"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            @empty
                                <p class="mb-0">{{ __('No widget...') }}</p>
                            @endforelse
                        </div>
                    </div>

                    <script>
                        $(function() {
                            createSortable();
                            function createSortable(){
                                var sortable = document.getElementById('widgets-container-{{ $widgetArea->id }}');
                                Sortable.create(sortable, {
                                    group: 'widgets-container',
                                    animation: 100,
                                    handle: '.grab-sortable',
                                    ghostClass: 'sort-components-sortable-ghost',  // Class name for the drop placeholder
                                    draggable: '.widget-item',  // Specifies which items inside the element should be draggable
                                    // Changed sorting within list
                                    onSort: function (/**Event*/evt) {
                                        let orders = {};
                                        $('#widgets-container-{{ $widgetArea->id }} .widget-item').each(function(i) {
                                            orders[$(this).data('id')] = {
                                                order: i,
                                                widget_area_id: {{ $widgetArea->id }}
                                            };
                                        });
                                        Livewire.emit('widgetOrderUpdated', orders)
                                    },
                                });
                            }
                        });
                    </script>
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
                        {{ Form::oselect('widget_plugin_form_id', $creatableWidgetPluginForms, $widget_plugin_form_id, ['wire:model.defer' => 'widget_plugin_form_id', 'wire:target' => 'createWidget', 'wire:loading.attr' => 'readonly', 'placeholder' => 'Choose a widget', 'class' => 'form-control', 'no-js' => true, 'no-label' => true]) }}
                    </div>
                    {{ Form::otext('widget_name', $widget_name, ['label' => __('Name'), 'wire:model.defer' => 'widget_name', 'wire:target' => 'createWidget', 'wire:loading.attr' => 'readonly']) }}

                    <div class="mt-4 text-right mr-2">
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
            <div class="card" id="form-edit-widget">
                <div class="card-body">


                    <h4>{{ __('Update') }}</h4>
                    <p>
                        {{ __('Update this widget') }}
                    </p>

                    <input type="hidden" name="id" value="{{ $editableWidget->id }}" />

                    {!! $editableWidgetForm['html'] !!}

                    <div class="mt-4 mb-2 text-right mr-2">
                        <button class="btn btn-primary btn-sm"
                                id="updateWidget"
                                wire:target="hideEditWidgetForm"
                                wire:loading.attr="disabled"
                                type="button">
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
            <script>
                $(function() {
                    let formContainer = $('#form-edit-widget');
                    let $btn = $('#updateWidget');

                    $btn.click(function(e) {

                        let data = getAllValues()

                        axios.put(route('omega.admin.content.pages.widgetarea.widgets.save', {
                            page: {{ $pageId }},
                            component: {{ $editableWidget->id }}
                        }), data)
                        .then(function(res) {
                            console.log(res)
                        });
                        @this.emit('updatedWidget')
                    });

                    function getAllValues() {
                        let inputValues = {};
                        formContainer.find(':input').each(function() {
                            let type = $(this).prop('type');
                            let name = $(this).prop('name');

                            // if the input is a codemirror, then force to save the content of the
                            // codemirror instance back to the textarea
                            if($(this).hasClass('codemirror-editor')) {
                                $(this).data('codemirror').save()
                            }

                            // checked radios/checkboxes
                            if ((type === 'checkbox' || type === 'radio') && this.checked) {
                                inputValues[name] = $(this).val();
                            }
                            // all other fields, except buttons
                            else if (type !== 'button' && type !== 'submit') {
                                inputValues[name] = $(this).val();
                            }
                        })
                        return inputValues;
                    }
                });
            </script>
        @endif

    </div>
</div>