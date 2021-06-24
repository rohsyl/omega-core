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

<input type="text" id="{{ $name }}" autocomplete="off" class="form-control form-control-lg {{ ($errors->has($from) || $errors->has($to) ? 'is-invalid' : '') }}" />
{{ Form::hidden($from, $value[0] ?? null, ['id' => $from]) }}
{{ Form::hidden($to, $value[1] ?? null, ['id' => $to]) }}

@if($errors->has($name))
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
        let start_date = $('#{{ $from }}').val();
        let end_date = $('#{{ $to }}').val();
        $('#{{ $name }}')
            .daterangepicker({
                @if(isset($attributes['autoApply']))
                autoApply: @json($attributes['autoApply']),
                @endif
                @if(isset($attributes['autoUpdateInput']))
                autoUpdateInput: @json($attributes['autoUpdateInput']),
                @endif
                startDate: start_date !== null && start_date.length > 0 ? start_date : moment(),
                endDate: end_date !== null && end_date.length > 0 ? end_date : moment(),
                singleDatePicker: false,
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
            }, function (start, end, label) {
                var years = moment().diff(start, 'years');
            })
            .on('apply.daterangepicker', function (ev, picker) {
                $('#{{ $from }}').val(picker.startDate.format('DD.MM.YYYY'));
                $('#{{ $to }}').val(picker.endDate.format('DD.MM.YYYY'));
            })
            .on('cancel.daterangepicker', function (ev, picker) {
                $(this).val('');
            });
    });
</script>
