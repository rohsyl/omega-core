<div wire:init="init"
    x-init=""
    x-data="{
        selectedMedia: null,
        selecteds: [],
        editSelectedMedia: function() {
            this.selecteds = [];
            $wire.emit('openModal', 'omega_media_modal_edit-media', {media: this.selectedMedia.id})
            this.selectedMedia = null;
        },
        deleteSelectedMedia: function() {
            this.selecteds = [];
            $wire.deleteFile(this.selectedMedia.id);
            this.selectedMedia = null;
        },
        back: function() {
            $wire.back();
            this.selectedMedia = null;
        }
    }"
>
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#" wire:click="home"><i class="fas fa-home"></i></a></li>

            </ol>
        </nav>
    </div>

    <div>
        <a href="#" class="btn btn-secondary btn-sm @if($directory->parent === null) disabled @endif" x-on:click="back()" wire:key="back-button">
            <i class="fas fa-arrow-left"></i> {{ __('Back') }}
        </a>
        |
        <a href="#" class="btn btn-outline-secondary btn-sm"
           wire:loading.class="disabled" wire:key="create-directory-button"
           wire:click="$emit('openModal', 'omega_media_modal_create-directory', {{ json_encode(["directory" => $directory->id]) }})">
            <i class="fas fa-folder-plus"></i>
            {{ __('Create directory') }}
        </a>
        <a href="#" class="btn btn-outline-secondary btn-sm"
           wire:loading.class="disabled" wire:key="upload-button"
           wire:click="$emit('openModal', 'omega_media_modal_upload', {{ json_encode(["directory" => $directory->id]) }})">
            <i class="fas fa-upload"></i>
            {{ __('Upload files') }}
        </a>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            @if(isset($directory))

                <div wire:loading>
                    <p class="text-center">
                        <i class="fas fa-spinner fa-spin"></i> Loading...
                    </p>
                </div>
                <div wire:loading.remove>
                    <div class="d-flex justify-content-start flex-wrap medias-container w-100">
                        @forelse($directory->children as $child)

                            <div x-data="{
                                id: {{ $child->id }},
                                media: @js($child->toMediaLibraryArray()),
                                onClick: function(e) {
                                    if(e.detail == 2) { // if double click
                                        this.selecteds = [];
                                        this.selectedMedia = null;
                                        $wire.call('openMedia', this.id);
                                    }
                                    else // else single click
                                    {
                                        if (e.ctrlKey) {
                                            this.selecteds[this.id] = this.id in this.selecteds ? !this.selecteds[this.id] : true;
                                            this.selectedMedia = null;
                                        }
                                        else {
                                            this.selecteds = [];
                                            this.selecteds[this.id] = this.id in this.selecteds ? !this.selecteds[this.id] : true;
                                            this.selectedMedia = this.media;
                                        }
                                    }
                                }
                            }"
                                 wire:key="{{ $child->id }}-{{ $child->updated_at }}"
                                 x-on:click="onClick($event)"
                                 x-bind:class="(id in selecteds && selecteds[id]) ? 'bg-primary text-white border-dark selected' : 'bg-white'"
                                 title="{{ $child->title ?? $child->name }}"
                                 class="mr-2 mb-2 pt-3 pb-0 border media-item rounded"
                                 style="width: 80px; cursor: pointer;"
                                 data-media="{{ htmlentities(json_encode($child->toMediaLibraryArray())) }}">
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


                            <p class="text-center">
                                {{ __('Empty directory...') }}
                            </p>

                        @endforelse
                    </div>
                </div>

            @endif
        </div>
        <div class="col-md-4">

            <!-- preview media -->
            <template x-if="selectedMedia != null">
                <div class="card w-100" >
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <div>
                                <i x-bind:class="selectedMedia.icon"></i>
                                <span x-text="selectedMedia.title ?? selectedMedia.name"></span>
                            </div>
                            <a href="#" x-on:click="selectedMedia = null" class="btn btn-link btn-sm p-0 m-0">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <hr />

                        <template x-if="selectedMedia.name !== 'PUBLIC'">
                            <div>
                                <a href="#" class="btn btn-outline-secondary btn-sm"
                                   x-on:click="editSelectedMedia()">
                                    <i class="fas fa-pen"></i>
                                    {{ __('Edit') }}
                                </a>
                                <a x-bind:href="selectedMedia.url_download" class="btn btn-outline-secondary btn-sm">
                                    <i class="fas fa-download"></i>
                                    {{ __('Download') }}
                                </a>
                                <a href="#" class="btn btn-outline-danger btn-sm" x-on:click="deleteSelectedMedia()">
                                    <i class="fas fa-trash"></i>
                                    {{ __('Delete') }}
                                </a>
                            </div>
                        </template>


                        <div class="mt-4">
                            <dl class="small row">
                                <dt class="col-4 text-truncate">{{ __('Name') }}</dt>
                                <dd class="col-8 text-truncate" x-text="selectedMedia.name"></dd>
                                <dt class="col-4 text-truncate">{{ __('Title') }}</dt>
                                <dd class="col-8 text-truncate" x-text="selectedMedia.title ?? '-'"></dd>
                                <dt class="col-4 text-truncate">{{ __('Description') }}</dt>
                                <dd class="col-8 text-truncate" x-text="selectedMedia.description ?? '-'"></dd>

                                <dt class="col-4 text-truncate">{{ __('Size') }}</dt>
                                <dd class="col-8 text-truncate">-</dd>
                                <dt class="col-4 text-truncate">{{ __('Ext') }}</dt>
                                <dd class="col-8 text-truncate" x-text="selectedMedia.ext ?? '-'">}</dd>
                            </dl>
                        </div>

                        <template x-if="selectedMedia.type == {{ \rohsyl\OmegaCore\Models\Media::TYPE_FILE }}">
                            <div class="mt-4" >
                                <p class="mb-1 font-weight-bold">{{ __('Preview') }}</p>
                                <div>

                                </div>
                                <template x-if="selectedMedia.media_type == '{{ \rohsyl\OmegaCore\Models\Media::MT_PICTURE }}'">
                                    <a x-bind:href="selectedMedia.url" target="_blank">
                                        <img x-bind:src="selectedMedia.url" style="max-height: 200px"/>
                                    </a>
                                </template>
                                <template x-if="selectedMedia.media_type != '{{ \rohsyl\OmegaCore\Models\Media::MT_PICTURE }}'">
                                    <a x-bind:href="selectedMedia.url" target="_blank">
                                        <i class="fa fa-external-link-alt"></i>
                                        {{ __('View file') }}
                                    </a>
                                </template>
                            </div>
                        </template>
                    </div>
                </div>
            </template>
            <!-- END preview media -->
        </div>
    </div>
</div>