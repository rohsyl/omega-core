<div class="mb-3">
    <div class="font-weight-bold">
        {{ $label }}
    </div>
    <div>
        @if(isset($value) && !empty($value))
            {!! $value !!}
        @else
            -
        @endif
    </div>
</div>