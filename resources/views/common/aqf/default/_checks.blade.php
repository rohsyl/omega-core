<div class="card">
    <div class="card-body p-15">
        @if(isset($checks))
            @foreach($checks as $check)
                {{ $check }}
            @endforeach
        @else
            {{ $slot }}
        @endif
    </div>
</div>
