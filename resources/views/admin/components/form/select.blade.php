<div class="form-group">
    @if (!isset($attributes['no-label']) || !$attributes['no-label'])
        {{ Form::label($name, $attributes['label'] ?? $name) }}
    @endif
    <select id="{{ $name }}" name="{{ $name }}"
            class="{{ isset($errors) && $errors->has($name) ? 'is-invalid' : '' }} {{ isset($attributes['class']) ? $attributes['class'] : 'form-control' }}">
        <option
            data-placeholder="true">{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : '' }}</option>
        @foreach($data as $key=>$line)
            @if ($value == $key)
                <option selected value="{{ $key }}">{{ $line }}</option>
            @else
                <option class="" value="{{ $key }}">{{ $line }}</option>
            @endif
        @endforeach
    </select>
    @if(isset($errors) && $errors->has($name))
        <small class="form-text text-danger">{{ $errors->first($name) }}</small>
    @endif
    @if(isset($attributes['helper']))
        <small class="form-text text-muted">{{ $attributes['helper'] }}</small>
    @endif
</div>

<script>
    new SlimSelect({
        select: '#{{ $name }}',
        allowDeselect: {{ isset($attributes['allowdeselect']) ? 'true' : 'false' }},
    })
</script>
