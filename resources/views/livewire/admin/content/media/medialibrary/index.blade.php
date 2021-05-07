<div wire:init="init">


    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" wire:click="home"><i class="fas fa-home"></i></a></li>

            </ol>
        </nav>
    </div>

    <div>
        @if($media->parent !== null)
            <a href="{{ route('omega.admin.content.media.index', ['directory' => $media->parent->id]) }}" class=" btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> {{ __('Back') }}
            </a>
        @else
            <a href="javascript:void(0)" disabled class="disabled btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> {{ __('Back') }}
            </a>
        @endif
        <a href="#" class="btn btn-outline-secondary btn-sm" wire:click="showCreateDirectoryForm">
            <i class="fas fa-folder-plus"></i>
            {{ __('Create directory') }}
        </a>
        <a href="#" class="btn btn-outline-secondary btn-sm" wire:click="showUploadForm">
            <i class="fas fa-upload"></i>
            {{ __('Upload files') }}
        </a>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            @if(isset($media))

                <div class="d-flex justify-content-start flex-wrap">
                    @forelse($media->children as $child)

                        <div title="{{ $child->title ?? $child->name }}"
                             class="mr-2 mb-2 pt-3 pb-0 border @if(isset($selectedMedia) && $selectedMedia->id == $child->id) bg-primary text-white border-dark @else bg-white @endif"
                             style="width: 80px; cursor: pointer;"
                             wire:click="selectMedia({{ $child->id }})"
                             wire:dblclick="openMedia({{ $child->id }})">
                            <div class="text-center">
                                <div>
                                    <i class="fa-2x {{ $child->icon }}"></i>
                                </div>
                                <small class="d-inline-block mt-1 px-1 text-truncate w-100">
                                    {{ $child->title ?? $child->name }}
                                </small>
                            </div>
                        </div>

                    @empty

                        <p>{{ __('Empty directory...') }}</p>

                    @endforelse
                </div>

            @endif
        </div>
        <div class="col-md-4">

            @if($showUploadForm)

                <div class="card">
                    <div class="card-body">
                        <livewire:omega_media-fileuploader :media="$media"/>
                    </div>
                </div>

            @endif

            @if($showCreateDirectoryForm)

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <i class="fas fa-folder-plus"></i>
                                {{ __('Create directory') }}
                            </div>
                            <a href="#" wire:click="closeCreateDirectoryForm" class="btn btn-link btn-sm p-0 m-0">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <hr />
                        {{ Form::otext('directory_name', null, ['label' => 'Directory', 'wire:model.defer' => 'directory_name', 'wire:target' => 'createDirectory', 'wire:loading.attr' => 'readonly']) }}
                        <button type="button" class="btn btn-primary"
                                wire:click="createDirectory"
                                wire:loading.attr="disabled"
                                wire:target="createDirectory">
                            <span wire:loading wire:target="createDirectory">
                                <i class="fas fa-spinner fa-spin"></i>
                            </span>
                            {{ __('Create') }}
                        </button>
                    </div>
                </div>

            @endif


            @if($showEditForm)

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <i class="fas fa-edit"></i>
                                {{ __('Edit media') }}
                            </div>
                            <a href="#" wire:click="closeEditForm" class="btn btn-link btn-sm p-0 m-0">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <hr />
                        {{ Form::otext('selectedMedia.name', $selectedMedia->name, ['label' => 'Name', 'wire:model.defer' => 'selectedMedia.name', 'wire:target' => 'editMedia', 'wire:loading.attr' => 'readonly']) }}
                        {{ Form::otext('selectedMedia.title', $selectedMedia->title, ['label' => 'Title', 'wire:model.defer' => 'selectedMedia.title', 'wire:target' => 'editMedia', 'wire:loading.attr' => 'readonly']) }}
                        {{ Form::otext('selectedMedia.description', $selectedMedia->description, ['label' => 'Description', 'wire:model.defer' => 'selectedMedia.description', 'wire:target' => 'editMedia', 'wire:loading.attr' => 'readonly']) }}

                        <button type="button" class="btn btn-primary"
                                wire:click="editMedia"
                                wire:loading.attr="disabled"
                                wire:target="editMedia">
                        <span wire:loading wire:target="editMedia">
                            <i class="fas fa-spinner fa-spin"></i>
                        </span>
                            {{ __('Update') }}
                        </button>
                    </div>
                </div>

            @endif

            @if(isset($selectedMedia) && !$showEditForm)

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <div>
                                <i class="{{ $selectedMedia->icon }}"></i>
                                {{ $selectedMedia->title ?? $selectedMedia->name }}
                            </div>
                            <a href="#" wire:click="selectMedia(null)" class="btn btn-link btn-sm p-0 m-0">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <hr />

                        <div>
                            @if($selectedMedia->name !== 'PUBLIC')
                                <a href="#" class="btn btn-outline-secondary btn-sm" wire:click="showEditForm">
                                    <i class="fas fa-pen"></i>
                                    {{ __('Edit') }}
                                </a>
                                <a href="{{ $selectedMedia->url_download }}" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm" wire:click="deleteFile">
                                    <i class="fas fa-trash"></i>
                                    {{ __('Delete') }}
                                </a>
                            @endif
                        </div>

                        <div class="mt-4">
                            <dl class="small row">
                                <dt class="col-4 text-truncate">{{ __('Name') }}</dt>
                                <dd class="col-8 text-truncate">{{ $selectedMedia->name }}</dd>
                                <dt class="col-4 text-truncate">{{ __('Title') }}</dt>
                                <dd class="col-8 text-truncate">{{ $selectedMedia->title ?? '-' }}</dd>
                                <dt class="col-4 text-truncate">{{ __('Description') }}</dt>
                                <dd class="col-8 text-truncate">{{ $selectedMedia->description ?? '-' }}</dd>

                                <dt class="col-4 text-truncate">{{ __('Size') }}</dt>
                                <dd class="col-8 text-truncate">{{ '-' }}</dd>
                                <dt class="col-4 text-truncate">{{ __('Ext') }}</dt>
                                <dd class="col-8 text-truncate">{{ $selectedMedia->ext ?? '-' }}</dd>
                            </dl>
                        </div>

                        @if($selectedMedia->type == \rohsyl\OmegaCore\Models\Media::TYPE_FILE)
                            <div class="mt-4">
                                <p class="mb-1 font-weight-bold">{{ __('Preview') }}</p>
                                @if($selectedMedia->media_type == \rohsyl\OmegaCore\Models\Media::MT_PICTURE)
                                    <a href="{{ $selectedMedia->url }}" target="_blank">
                                        <img src="{{ $selectedMedia->url }}" style="max-height: 200px"/>
                                    </a>
                                @else
                                    <a href="{{ $selectedMedia->url }}" target="_blank">
                                        <i class="fa fa-external-link-alt"></i>
                                        {{ __('View file') }}
                                    </a>
                                @endif
                            </div>
                        @endif

                    </div>
                </div>

            @endif
        </div>
    </div>



</div>
<style>

</style>