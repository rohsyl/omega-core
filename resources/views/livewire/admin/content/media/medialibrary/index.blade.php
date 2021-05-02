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
            <a href="#" wire:click="openMedia({{ $media->parent->id }})" class=" btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> {{ __('Back') }}
            </a>
        @else
            <a href="#" disabled class="disabled btn btn-secondary btn-sm">
                <i class="fas fa-arrow-left"></i> {{ __('Back') }}
            </a>
        @endif
        <a href="#" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-folder-plus"></i>
            {{ __('Create directory') }}
        </a>
        <a href="#" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-upload"></i>
            {{ __('Upload files') }}
        </a>
    </div>

    <div class="row mt-4">
        <div class="col-md-8">
            @if(isset($media))

                <div class="d-flex justify-content-start">
                    @forelse($media->children as $child)

                        <div class="mr-2 mb-2 py-2 border @if(isset($selectedMedia) && $selectedMedia->id == $child->id) bg-grey @else bg-white @endif" style="width: 80px; cursor: pointer;"
                             wire:click="selectMedia({{ $child->id }})"
                             wire:dblclick="openMedia({{ $child->id }})">
                            <div class="text-center">
                                <div>
                                    @if($child->type == \rohsyl\OmegaCore\Models\Media::TYPE_DIRECTORY)
                                        <i class="fas fa-2x fa-folder"></i>
                                    @else
                                        <i class="fas fa-2x fa-file"></i>
                                    @endif
                                </div>
                                <small>
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
            @if(isset($selectedMedia))

                <div class="card">
                    <div class="card-body">

                        <div class="d-flex justify-content-between">
                            <div>
                                <i class="fas fa-folder"></i>
                                {{ $selectedMedia->title ?? $selectedMedia->name }}
                            </div>
                            <a href="#" wire:click="selectMedia(null)" class="btn btn-link btn-sm p-0 m-0">
                                <i class="fas fa-times"></i>
                            </a>
                        </div>
                        <hr />

                        <div>
                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-pen"></i>
                                {{ __('Rename') }}
                            </a>
                            <a href="#" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-trash"></i>
                                {{ __('Delete') }}
                            </a>
                        </div>


                    </div>
                </div>

            @endif
        </div>
    </div>



</div>
<style>

</style>