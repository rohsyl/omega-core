<div class="input-group">
    <label class="css-control css-control-primary css-checkbox">
        {{ Form::hidden($name, 0) }}
        {{ Form::checkbox($name, 1, old($name) ?? $value, array_merge(['class' => 'css-control-input ' . (isset($errors) && $errors->has($name) ? 'is-invalid' : '')], $attributes)) }}
        <span class="css-control-indicator"></span>
        @if (!isset($attributes['no-label']) || !$attributes['no-label'])
            {{ Form::label($name, $attributes['label'] ?? $name) }}
        @endif
    </label>
</div>
@if(isset($errors) && $errors->has($name))
    <small class="form-text text-danger">{{ $errors->first($name) }}</small>
@endif
@if(isset($attributes['helper']))
    <div class="mb-4">
        <small class="form-text text-muted">{{ $attributes['helper'] }}</small>
    </div>
@endif
