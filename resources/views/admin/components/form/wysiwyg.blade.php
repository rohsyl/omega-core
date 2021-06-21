<div class="form-group">
    @if (!isset($attributes['no-label']) || !$attributes['no-label'])
        {{ Form::label($name, $attributes['label'] ?? $name) }}
    @endif
    {{ Form::textarea($name, old($name) ?? $value, array_merge(['id' => $name, 'cols'=>3, 'rows'=>5,'class' => 'form-control ' . (isset($errors) && $errors->has($name) ? 'is-invalid' : '')], $attributes)) }}
    @if(isset($errors) && $errors->has($name))
        <small class="form-text text-danger">{{ $errors->first($name) }}</small>
    @endif
    @if(isset($attributes['helper']))
        <small class="form-text text-muted">{{ $attributes['helper'] }}</small>
    @endif
</div>
<script>
    $(function() {
        $('#{{ $name}}').summernote({
            minHeight: 300,
        });
    });
</script>
