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
{{ Form::text($name, old($name) ?? $value, array_merge(['id'=>$name,isset($syncedAttributes) && in_array($name, $syncedAttributes) ? 'disabled' : '','class' => 'form-control ' . (isset($errors) && $errors->has($name) ? 'is-invalid' : '')])) }}
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
                @if(isset($attributes['autoUpdateInput']))
                autoApply: @json($attributes['autoUpdateInput']),
                @endif
                singleDatePicker: true,
                showDropdowns: true,
                minYear: 1901,
                maxYear: parseInt(moment().add(10, 'years').format('YYYY'), 10),
                //autoUpdateInput: false,
                ranges: {
                    'Last Year': [moment().startOf('year'), moment().startOf('year')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').startOf('month')],
                    'Today': [moment()],
                    'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').startOf('month')],
                    'Next Year': [moment().add(1, 'year').startOf('year'), moment().add(1, 'year').startOf('year')]
                },
                locale: {
                    cancelLabel: 'Clear',
                    format: 'DD.MM.YYYY',
                },
                showCustomRangeLabel: false
            }, function (start, end, label) {
                var years = moment().diff(start, 'years');
            })
            .on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('DD.MM.YYYY'));
            })
            .on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
    });
</script>
