<div class="form-group">
    @if(isset($title) && !empty($title))
        <label for="{{ $uid }}" class="font-weight-bold">{{ $title }}</label>
    @endif
    @if(isset($type))
        {!! $type->getHtml() !!}
    @else
        <div class="alert alert-danger">{{ __('Entry type doesn\'t exists ...') }}</div>
    @endif
    @if(isset($description) && !empty($description))
        <span class="help-block small text-muted">{{ $description }}</span>
    @endif
</div>