<div class="input-group">
    <label class="css-control css-control-primary css-radio">
        {{ Form::radio($name, $checked, old($name) ?? $value, array_merge([isset($syncedAttributes) && in_array($name, $syncedAttributes) ? 'disabled' : '','class' => 'css-control-input ' . (isset($errors) && $errors->has($name) ? 'is-invalid' : '')], $attributes)) }}
        <span class="css-control-indicator"></span>
        @if (!isset($attributes['no-label']) || !$attributes['no-label'])
            {{ Form::label($name, $attributes['label'] ?? $name) }}
        @endif
    </label>
</div>
@if(isset($attributes['helper']))
    <div class="mb-4">
        <small class="form-text text-muted">{{ $attributes['helper'] }}</small>
    </div>
@endif
@if(isset($errors) && $errors->has($name))
    <small class="form-text text-danger">{{ $errors->first($name) }}</small>
@endif
