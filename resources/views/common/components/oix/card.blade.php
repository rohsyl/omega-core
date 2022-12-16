<div class="card mb-2">
    <div class="card-body">
        <div class="row">
            @if(isset($title))
                <div class="col-md-3">
                    @if(isset($title))
                    <h5 class="mb-0">
                        {{ $title }}
                    </h5>
                    @endif
                    @if(isset($subtitle))
                    <p class="text-muted">
                        {{ $subtitle }}
                    </p>
                    @endif
                </div>
            @endif
            <div class="@if(isset($title)) col-md-9 @else col-md-12 @endif">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>