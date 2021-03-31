

<div>

    <div class="text-right mb-2">
        <button class="btn btn-primary btn-sm"
                type="submit">
            <i class="fas fa-save"></i>
            {{ __('Save') }}
        </button>
    </div>

    {{ Form::open(['url' => route('omega.admin.content.pages.update', $page), 'method' => 'put']) }}
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="content-tab" data-toggle="tab" href="#content" role="tab" aria-controls="content" aria-selected="true">{{ __('Content') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="settings-tab" data-toggle="tab" href="#settings" role="tab" aria-controls="settings" aria-selected="false">{{ __('Settings') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="widgetarea-tab" data-toggle="tab" href="#widgetarea" role="tab" aria-controls="widgetarea" aria-selected="false">{{ __('Widget area') }}</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="security-tab" data-toggle="tab" href="#security" role="tab" aria-controls="security" aria-selected="false">{{ __('Security') }}</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="content" role="tabpanel" aria-labelledby="content-tab">

                <div class="row">
                    <div class="col-md-8">

                        @foreach($componentsForms as $form)
                            <div class="card" id="{{ $form['id'] }}-{{ $form['name'] }}">
                                <div class="card-header p-10 d-flex justify-content-between">
                                    <div>
                                        {{ $form['name'] }}
                                    </div>
                                    <div>
                                        <a class="text-danger" href="#" wire:click="deleteComponent({{ $form['id'] }})"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                                <div class="card-body p-10">
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
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">

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
                                {{ Form::text('title', $page->title, ['class' => 'form-control', 'paceholder' => __('Title')]) }}
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

                        {{ Form::oselect('parent_id', $pages, $page->parent_id, ['label' => __('Parent'), 'helper' => __('Define the parent of this page to organize your hierarchy.')]) }}
                        {{ Form::oselect('model', $models, $page->model, ['label' => __('Model'), 'helper' => __('Define an alternative page template for this page.')]) }}
                        {{ Form::oselect('menu_id', $menus, $page->menu_id, ['label' => __('Menu'), 'helper' => __('Define the menu to use on this page.')]) }}


                        {{ Form::otext('keyword', $page->keyword, ['label' => __('Keywords'), 'helper' => __('Keywords for this page.')]) }}
                    </div>
                </div>

            </div>
            <div class="tab-pane fade" id="widgetarea" role="tabpanel" aria-labelledby="widgetarea-tab">...</div>
            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">...</div>
        </div>
    {{ Form::close() }}
</div>