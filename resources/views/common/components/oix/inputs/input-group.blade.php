<div class="form-group">
    @if(isset($label))
        {{ Form::label($name, $label) }}
    @endif
    <div class="input-group">
        {{ $slot }}
    </div>
    @if(isset($errors) && $errors->has($name))
        <small class="form-text text-danger">{{ $errors->first($name) }}</small>
    @endif
    @if(isset($helper))
        <small class="form-text text-muted">{{ $helper }}</small>
    @endif
</div>
