<div class="card mb-2">
    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <h5 class="mb-0">
                    {{ $title }}
                </h5>
                @if(isset($subtitle))
                <p class="text-muted">
                    {{ $subtitle }}
                </p>
                @endif
            </div>
            <div class="col-md-9">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>