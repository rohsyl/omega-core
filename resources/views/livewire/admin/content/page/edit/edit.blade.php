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

                        @foreach($componentsForms as $form)
                            <div class="card" id="{{ $form['id'] }}-{{ $form['name'] }}">
                                <div class="card-header p-10 d-flex justify-content-between">
                                    <div>
                                        {{ \Illuminate\Support\Str::title($form['name']) }}
                                    </div>
                                    <div>
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
                    <div class="col-md-4">
                        <div class="mt-3">
                            <button class="btn btn-outline-primary btn-sm"
                                    type="button"
                                    wire:click="showAddComponentForm"
                                    wire:target="showAddComponentForm"
                                    wire:loading.attr="disabled"
                            >
                                <i class="fas fa-plus"></i>
                                {{ __('Add component') }}
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

                                <div class="card">
                                    <div class="card-body">
                                        <h4>{{ __('Edit') }} {{ \Illuminate\Support\Str::title($settingsEditableComponent->plugin_form->plugin->name) }}'s {{ __('settings') }}</h4>
                                        <p>
                                            {{ __('Here you can configure your component\'s settings...') }}
                                        </p>


                                        {{ Form::otext('compId', $settingsEditableComponent->settings['compId'] ?? null, ['label' => __('Component ID'), 'helper' => __('Set the #id of the component\'s section.')]) }}
                                        {{ Form::otext('compTitle', null, ['label' => __('Component Title'), 'helper' => __('A title for the component.')]) }}
                                        {{ Form::oselect('compTemplate', $componentTemplates, null, ['label' => __('Component\'s template'), 'helper' => __('Choose the template for this component'), 'no-js' => true, 'class' => 'form-control']) }}
                                        {{ Form::ocheckbox('is_hidden', null, ['label' => __('Hide the component')]) }}
                                        {{ Form::oselect('comp_width', $componentWidths, null, ['label' => __('Component width'), 'helper' => __('Keywords for this page.'), 'no-js' => true, 'class' => 'form-control']) }}

                                        <div class="mt-4 text-right">
                                            <button class="btn btn-outline-secondary btn-sm"
                                                    type="button"
                                                    wire:click="hideSettingsComponentForm"
                                                    wire:target="hideSettingsComponentForm"
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
                </div>

            </div>
            <div class="tab-pane fade @if($tab == 'settings') show active @endif" id="settings" role="tabpanel" aria-labelledby="settings-tab">

                <div class="card">
                    <div class="card-body">

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

                        {{ Form::oselect('parent_id', $pageParents, $page->parent_id, ['label' => __('Parent'), 'helper' => __('Define the parent of this page to organize your hierarchy.'), 'class' => 'form-control']) }}
                        {{ Form::oselect('model', $pageModels, $page->model, ['label' => __('Model'), 'helper' => __('Define an alternative page template for this page.'), 'class' => 'form-control']) }}
                        {{ Form::oselect('menu_id', $pageMenus, $page->menu_id, ['label' => __('Menu'), 'helper' => __('Define the menu to use on this page.'), 'class' => 'form-control']) }}


                        {{ Form::otext('keyword', $page->keyword, ['label' => __('Keywords'), 'helper' => __('Keywords for this page.')]) }}
                    </div>
                </div>

            </div>
            <div class="tab-pane fade @if($tab == 'widgetarea') show active @endif" id="widgetarea" role="tabpanel" aria-labelledby="widgetarea-tab">

                <div class="mt-2">

                    <div class="row">
                        <div class="col-md-8">
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
                        <div class="col-md-4">

                            @if($showAddWidgetForm)
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            {{ Form::label('widget_plugin_form_id', __('Widget')) }}
                                            {{ Form::select('widget_plugin_form_id', $creatableWidgetPluginForms, $widget_plugin_form_id, ['wire:model.defer' => 'widget_plugin_form_id', 'wire:target' => 'createWidget', 'wire:loading.attr' => 'readonly', 'class' => 'form-control']) }}
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

                </div>


            </div>
            <div class="tab-pane fade @if($tab == 'security') show active @endif" id="security" role="tabpanel" aria-labelledby="security-tab">...</div>
        </div>
    {{ Form::close() }}
</div>