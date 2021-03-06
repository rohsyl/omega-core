@php

    $attributes['autoUpdateInput'] = false;
@endphp

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
{{ Form::text($name, old($name) ?? $value, array_merge($attributes, ['id'=>$name,'class' => 'form-control ' . (isset($errors) && $errors->has($name) ? 'is-invalid' : '')])) }}
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
<div class="mb-3"> </div>
<script type="text/javascript">
    $(function () {
        $('#{{ $name }}')
            .daterangepicker({
                @if(isset($attributes['autoApply']))
                autoApply: @json($attributes['autoApply']),
                @endif
                @if(isset($attributes['autoUpdateInput']))
                autoUpdateInput: @json($attributes['autoUpdateInput']),
                @endif
                timePicker: true,
                timePicker24Hour: true,
                timePickerSeconds: false,
                timePickerIncrement: @isset($attributes['increment']) @json($attributes['increment']) @else 1 @endif,
                showCustomRangeLabel: false,
                showDropdowns: true,

                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour').add(1, 'hour'),
                locale: {
                    cancelLabel: 'Clear',
                    format: 'HH:mm'
                }
            })
            .on('show.daterangepicker', function (ev, picker) {
                picker.container.find(".calendar-table").hide();
            })
            .on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('HH:mm') + ' - ' + picker.endDate.format('HH:mm'));
            })
            .on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
    });
</script>
