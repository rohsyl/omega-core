<div class="form-group">
    @if (!isset($attributes['no-label']) || !$attributes['no-label'])
        {{ Form::label($name, $attributes['label'] ?? $name) }}
    @endif
    <div class="input-group">
        @if (isset($attributes['prepend']))
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">{{ $attributes['prepend']   }}</span>
            </div>
        @endif
        {{ Form::number($name, old($name) ?? $value, array_merge(['class' => 'form-control form-control-lg ' . (isset($errors) && $errors->has($name) ? 'is-invalid' : '')], $attributes)) }}
        @if (isset($attributes['append']))
            <div class="input-group-append">
                <span class="input-group-text" id="basic-addon1">{{ $attributes['append'] }}</span>
            </div>
        @endif
    </div>
    @if(isset($errors) && $errors->has($name))
        <small class="form-text text-danger">{{ $errors->first($name) }}</small>
    @endif
    @if(isset($attributes['helper']))
        <small class="form-text text-muted">{{ $attributes['helper'] }}</small>
    @endif
</div>
