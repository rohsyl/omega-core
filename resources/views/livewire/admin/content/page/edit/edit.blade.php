<div>
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
        <div class="tab-pane fade show active pt-2" id="content" role="tabpanel" aria-labelledby="content-tab">

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

                    <button class="btn btn-primary btn-sm"
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
        <div class="tab-pane fade" id="settings" role="tabpanel" aria-labelledby="settings-tab">...</div>
        <div class="tab-pane fade" id="widgetarea" role="tabpanel" aria-labelledby="widgetarea-tab">...</div>
        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">...</div>
    </div>
</div>