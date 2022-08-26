<div wire:init="init">
    {{ Form::open(['url' => route('omega.admin.content.pages.update', $page), 'method' => 'put']) }}

    <div class="d-flex justify-content-between mb-2">
        <div>
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.content.pages.index') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
        </div>
        <div class="text-right">
            <a class="btn btn-dark btn-sm"
                href="{{ $page->url }}">
                <i class="fas fa-eye"></i>
                {{ __('View') }}
            </a>
            <button class="btn btn-primary btn-sm"
                    name="action"
                    value="save"
                    type="submit">
                <i class="fas fa-save"></i>
                {{ __('Save') }}
            </button>
            @if($page->is_published)
                <button class="btn btn-secondary btn-sm"
                        name="action"
                        value="unpublish"
                        type="submit">
                    <i class="fas fa-eye-slash"></i>
                    {{ __('Unpublish') }}
                </button>
            @else
                <button class="btn btn-info btn-sm"
                         name="action"
                         value="publish"
                         type="submit">
                    <i class="fas fa-globe"></i>
                    {{ __('Publish') }}
                </button>
            @endif
        </div>
    </div>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($tab == 'content') active @endif" wire:click="setTab('content')" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content">{{ __('Content') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($tab == 'settings') active @endif" wire:click="setTab('settings')" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings">{{ __('Settings') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($tab == 'widgetarea') active @endif" wire:click="setTab('widgetarea')" id="widgetarea-tab" data-toggle="tab" href="#widgetarea" role="tab" aria-controls="widgetarea">{{ __('Widget area') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($tab == 'security') active @endif" wire:click="setTab('security')" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security">{{ __('Security') }}</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade @if($tab == 'content') show active @endif" id="content" role="tabpanel" aria-labelledby="content-tab">

                <div class="row">
                    <div class="col-md-8">
                        <div id="components-container">
                            @foreach($componentsForms as $form)
                                <div class="card component-item" id="{{ $form['id'] }}-{{ $form['name'] }}" data-id="{{ $form['id'] }}">
                                    {{ Form::hidden('components_order['.$form['id'].']', $form['order']) }}
                                    <div class="card-header p-10 d-flex justify-content-between">
                                        <div>
                                            <span class="text-dark">
                                                @if(isset($form['settings']['compTitle']) && !empty($form['settings']['compTitle']))
                                                    {{ $form['settings']['compTitle'] }}
                                                    ({{  \Illuminate\Support\Str::title($form['name']) }})
                                                @else

                                                    {{  \Illuminate\Support\Str::title($form['name']) }}
                                                @endif
                                            </span>
                                            <ul class="list-unstyled list-inline d-inline-block ml-2">
                                                @if(isset($form['settings']['isHidden']) && $form['settings']['isHidden'])
                                                    <li class="list-inline-item" title="{{ __('Component is not displayed on the page.') }}"><i class="fa fa-eye-slash" id="hidden-comp-{{ $form['id'] }}"></i></li>
                                                @endif
                                                @if(isset($form['settings']['isWrapped']) && !$form['settings']['isWrapped'])
                                                    <li class="list-inline-item" data-toggle="tooltip" title="{{ __('Component will be rendered full width.') }}"><i class="fas fa-arrows-alt-h" id="fullwidth-comp-{{ $form['id'] }}"></i></li>
                                                @endif
                                                @if(isset($form['settings']['pluginTemplate']) && !empty($form['settings']['pluginTemplate']))
                                                    <li class="list-inline-item" data-toggle="tooltip" title="{{ __('A component template is applied.') }}"><i class="fa fa-exclamation-circle" id="template-comp-{{ $form['id'] }}"></i></li>
                                                @endif
                                                @if(isset($form['settings']['compId']) && !empty($form['settings']['compId']))
                                                    <li class="list-inline-item"><i class="fa fa-hashtag" id="id-comp-{{ $form['id'] }}"></i>{{ $form['settings']['compId'] }}</li>
                                                @endif
                                            </ul>
                                        </div>
                                        <div>
                                            <span class="grab-sortable mr-2" style="cursor:grab;"><i class="fas fa-arrows-alt"></i></span>
                                            <a class="mr-2" href="#" wire:click="showSettingsComponentForm({{ $form['id'] }})"><i class="fas fa-cog"></i></a>
                                            <a class="text-danger" href="#" wire:click="deleteComponent({{ $form['id'] }})"><i class="fas fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <div class="card-body p-10" wire:ignore>
                                        {!! $form['html'] !!}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <script>
                            $(function() {
                                createSortable();
                                function createSortable(){
                                    var sortable = document.getElementById('components-container');
                                    Sortable.create(sortable, {
                                        group: 'sort-components',
                                        animation: 100,
                                        handle: '.grab-sortable',
                                        ghostClass: 'sort-components-sortable-ghost',  // Class name for the drop placeholder
                                        draggable: '.component-item',  // Specifies which items inside the element should be draggable
                                        // Changed sorting within list
                                        onSort: function (/**Event*/evt) {
                                            let orders = {};
                                            $('#components-container .component-item').each(function(i) {
                                                orders[$(this).data('id')] = i;
                                                $(this).find('input[name^="components_order"]').val(i);

                                            });
                                            setTimeout(function () {
                                                Livewire.emit('orderUpdated', orders)
                                            }, 500)
                                        },
                                    });
                                }
                            });
                        </script>
                        <style>
                            .sort-components-sortable-ghost {
                                background-color: #cccccc;
                            }
                        </style>

                    </div>
                    <div class="col-md-4">
                        <div class="mt-3">

                            <button wire:click="$emit('openModal', 'omega_edit_modal_add-component', {{ json_encode(['page' => $page->id]) }})">
                                <i class="fas fa-plus"></i>
                                {{ __('Add component') }}
                            </button>


                            <button class="btn btn-outline-primary btn-sm"
                                    type="button"
                                    wire:click="showAddComponentForm"
                                    wire:target="showAddComponentForm"
                                    wire:loading.attr="disabled"
                            >

                            </button>

                            @if($showAddComponentForm)
                                <div class="card">
                                    <div class="card-body">
                                        <h4>{{ __('Add component') }}</h4>
                                        <p>
                                            {{ __('Click on any component in the list below to add it to the content of your page') }}
                                        </p>
                                        <div class="list-group">
                                            @foreach($creatablePluginForms as $pluginForm)
                                                <button class="list-group-item list-group-item-action"
                                                        wire:click="createComponent({{ $pluginForm->id }})">
                                                    {{ $pluginForm->name }}
                                                </button>
                                            @endforeach
                                        </div>

                                        <div class="mt-4 text-right">
                                            <button class="btn btn-outline-secondary btn-sm"
                                                    type="button"
                                                    wire:click="hideAddComponentForm"
                                                    wire:target="hideAddComponentForm"
                                                    wire:loading.attr="disabled"
                                            >
                                                {{ __('Cancel') }}
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            @endif

                            @if($showSettingsComponentForm)
                                <livewire:omega_edit-page-componentsettings key="{{ now() }}" :component="$settingsEditableComponent" wire:settingsSaved="hideSettingsComponentForm" />
                            @endif
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade @if($tab == 'settings') show active @endif" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                <x-oix-card title="{{ __('Informations') }}" subtitle="{{ __('Details about the page') }}">

                    <div class="form-group">
                        {{ Form::label('title', __('Title'), ['class' => 'control-label']) }}
                        <div class="input-group">
                            <span class="input-group-prepend">
                                <span class="input-group-text">
                                    {{ Form::hidden('show_title', 0) }}
                                    {{ Form::checkbox('show_title', 1, $page->show_title) }}
                                </span>
                            </span>
                            {{ Form::text('title', $page->title, ['class' => 'form-control', 'placeholder' => __('Title')]) }}
                        </div>
                        @if ($errors->has('title'))
                            <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                        @else
                            <small class="form-text text-muted">
                                {{ __('The title of the page') }}
                            </small>
                        @endif
                    </div>


                    <div class="form-group">
                        {{ Form::label('subtitle', __('Sub-title'), ['class' => 'control-label']) }}
                        <div class="input-group">
                                <span class="input-group-prepend">
                                    <span class="input-group-text">
                                        {{ Form::hidden('show_subtitle', 0) }}
                                        {{ Form::checkbox('show_subtitle', 1, $page->show_subtitle) }}
                                    </span>
                                </span>
                            {{ Form::text('subtitle', $page->subtitle, ['class' => 'form-control', 'paceholder' => __('Sub-title')]) }}
                        </div>
                        @if ($errors->has('subtitle'))
                            <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('subtitle') }}</strong>
                                </span>
                        @else
                            <small class="form-text text-muted">
                                {{ __('The sub-title of the page') }}
                            </small>
                        @endif
                    </div>

                    {{ Form::otext('slug', $page->slug, ['label' => __('Slug'), 'helper' => __('The slug is used in the URL')]) }}
                </x-oix-card>

                <x-oix-card title="{{ __('Related') }}" subtitle="{{ __('Set up the parent or the menu related to this page') }}">

                    {{ Form::oselect('parent_id', $pageParents, $page->parent_id, ['label' => __('Parent'), 'helper' => __('Define the parent of this page to organize your hierarchy.'), 'class' => 'form-control']) }}
                    {{ Form::oselect('menu_id', $pageMenus, $page->menu_id, ['label' => __('Menu'), 'helper' => __('Define the menu to use on this page.'), 'class' => 'form-control']) }}

                </x-oix-card>

                <x-oix-card title="{{ __('Customization') }}" subtitle="{{ __('Change the look and feel of the page') }}">
                    {{ Form::oselect('model', $pageModels, $page->model, ['label' => __('Model'), 'helper' => __('Define an alternative page template for this page.'), 'class' => 'form-control']) }}
                </x-oix-card>

                <x-oix-card title="{{ __('SEO') }}" subtitle="{{ __('Configure SEO for this page') }}">
                    {{ Form::otext('keyword', $page->keyword, ['label' => __('Keywords'), 'helper' => __('Keywords for this page.')]) }}
                </x-oix-card>

            </div>
            <div class="tab-pane fade @if($tab == 'widgetarea') show active @endif" id="widgetarea" role="tabpanel" aria-labelledby="widgetarea-tab">

                <div class="mt-2">

                    <livewire:omega_edit-page-widgetareas :page_id="$page->id" />


                </div>


            </div>
            <div class="tab-pane fade @if($tab == 'security') show active @endif" id="security" role="tabpanel" aria-labelledby="security-tab">...</div>
        </div>
    {{ Form::close() }}
</div>