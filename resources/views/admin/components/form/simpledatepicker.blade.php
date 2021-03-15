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
    <div class="input-group">
        {{ Form::text($name, $value, array_merge(
            ['class' => 'form-control ' . (isset($errors) && $errors->has($name) ? 'is-invalid' : ''),
            'id' => $name,
            'data-toggle' => 'datetimepicker',
            'data-target' => '#'.$name,
            'autocomplete' => 'off'
            ], $attributes)) }}
    </div>
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
    <script type="text/javascript">
        $(function () {
            $('#{{ $name }}').datetimepicker({
                icons: {
                    time: 'fas fa-clock',
                    date: 'fas fa-calendar',
                    up: 'fas fa-arrow-up',
                    down: 'fas fa-arrow-down',
                    previous: 'fas fa-chevron-left',
                    next: 'fas fa-chevron-right',
                    today: 'fas fa-calendar-check-o',
                    clear: 'fas fa-trash',
                    close: 'fas fa-times'
                },
                format: 'DD.MM.YYYY',
                locale: '{{ App::getLocale() }}'
            });
        });
    </script>
</div>
