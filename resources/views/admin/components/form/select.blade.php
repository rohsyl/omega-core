@php
    $value = old($name) ?? $value;

    // livewire compatibility
    $wireAttributes = array_filter(
        $attributes,
        function ($attributeName){
            return strpos( $attributeName, "wire:" ) === 0;
        },
        ARRAY_FILTER_USE_KEY
    );
    $hasLivewire = sizeof($wireAttributes) > 0;
@endphp
<div class="form-group">
    @if (!isset($attributes['no-label']) || !$attributes['no-label'])
        {{ Form::label($name, $attributes['label'] ?? $name) }}
    @endif
    <select id="{{ $name }}" name="{{ $name }}" onchange="{{ isset($attributes['on-change']) ? $attributes['on-change'] : '' }}"
            class="{{ isset($errors) && $errors->has($name) ? 'is-invalid' : '' }} {{ isset($attributes['class']) ? $attributes['class'] : '' }}"
        @foreach($wireAttributes as $wireName => $wireValue)
            {{ $wireName }}="{{ $wireValue }}"
        @endforeach
    >

        <option {{ ($value != null) ? 'value="' . $value . '"' : 'selected'   }}
            data-placeholder="true">{{ isset($attributes['placeholder']) ? $attributes['placeholder'] : '' }}</option>
        @foreach($data as $key=>$line)
            @if (($value != null) && $value == $key)
                <option selected value="{{ $key }}" @if($hasLivewire) wire:key="{{ $key }}" @endif>{{ $line }}</option>
            @else
                <option value="{{ $key }}" @if($hasLivewire) wire:key="{{ $key }}" @endif>{{ $line }}</option>
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

@if(!isset($attributes['no-js']) || !$attributes['no-js'])
<script>
    new SlimSelect({
        select: '#{{ $name }}',
        showSearch:  {{ isset($attributes['show-search']) ? 'true' : 'false' }},
        {!! isset($attributes['search-text']) ? 'searchText: \'' . $attributes['search-text'] . '\',' : '' !!}
        {!! isset($attributes['search-placeholder']) ? 'searchPlaceholder: \'' . $attributes['search-placeholder'] . '\',' : '' !!}
        searchFocus: {{ isset($attributes['search-focus']) ? 'true' : 'false' }}, // Whether or not to focus on the search input field
        searchHighlight: {{ isset($attributes['search-highlight']) ? 'true' : 'false' }},
        allowDeselect: {{ isset($attributes['allowdeselect']) ? 'true' : 'false' }},
    })
    window.addEventListener('form-rendered', function(e) {
        new SlimSelect({
            select: '#{{ $name }}',
            showSearch:  {{ isset($attributes['show-search']) ? 'true' : 'false' }},
            {!! isset($attributes['search-text']) ? 'searchText: \'' . $attributes['search-text'] . '\',' : '' !!}
            {!! isset($attributes['search-placeholder']) ? 'searchPlaceholder: \'' . $attributes['search-placeholder'] . '\',' : '' !!}
            searchFocus: {{ isset($attributes['search-focus']) ? 'true' : 'false' }}, // Whether or not to focus on the search input field
            searchHighlight: {{ isset($attributes['search-highlight']) ? 'true' : 'false' }},
            allowDeselect: {{ isset($attributes['allowdeselect']) ? 'true' : 'false' }},
        })
    });
</script>
@endif