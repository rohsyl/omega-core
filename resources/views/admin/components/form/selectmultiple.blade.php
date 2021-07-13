<div class="form-group">
    @if (!isset($attributes['no-label']))
        @if(isset($attributes['label']))
            @if(Lang::has('resource.'.$attributes['label'].'.field.'.$name.'.label'))
                {{ Form::label($name, __('resource.'.$attributes['label'].'.field.'.$name.'.label')) }}
            @else
                {{ Form::label($name, $attributes['label']) }}
            @endif
        @elseif(Lang::has('label.'.$name))
            {{ Form::label($name, __('label.'.$name)) }}
        @else
            {{ Form::label($name, $name) }}
        @endif
    @endif
    {{ Form::select($name.'[]', $data, $value, array_merge(['id'=>\Illuminate\Support\Str::slug($name, '_'),'class' => '' . (isset($errors) && $errors->has($name) ? 'is-invalid' : ''), 'multiple' => 'true', 'size' => 4], $attributes)) }}
    @if(isset($errors) && $errors->has($name))
        <small class="form-text text-danger">{{ $errors->first($name) }}</small>
    @endif
    @if(isset($attributes['helper']))
        @if(Lang::has('resource.'.$attributes['label'].'.field.'.$name.'.helper'))
            <small class="form-text text-muted">{{ __('resource.'.$attributes['helper'].'.field.'.$name.'.helper') }}</small>
        @else
            <small class="form-text text-muted">{{ $attributes['helper'] }}</small>
        @endif
    @endif
</div>

<script>
    var select{{ \Illuminate\Support\Str::slug($name, '_') }} = new SlimSelect({
        select: '#{{ \Illuminate\Support\Str::slug($name, '_') }}',
        closeOnSelect: false
    })

    window.addEventListener('form-rendered', function(e) {
        var select{{ \Illuminate\Support\Str::slug($name, '_') }} = new SlimSelect({
            select: '#{{ \Illuminate\Support\Str::slug($name, '_') }}',
            closeOnSelect: false
        })
    })
</script>
