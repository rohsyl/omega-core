@if(url()->current() != url()->previous())
    <a class="{{ isset($attributes['class']) ? $attributes['class'] : 'btn btn-secondary' }}" href="{{ url()->previous() }}">
        <i class="fa fa-arrow-left"></i> {{ isset($attributes['name']) ? $attributes['name'] : __('Back') }}
    </a>
@endif
