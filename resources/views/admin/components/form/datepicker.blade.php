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
                @isset($attributes['range'])
                    @if ($attributes['range'] == 'Today')
                        ranges: {
                            '{{ __('omega::component.date_picker.Today') }}': [moment()],
                        },
                    @elseif ($attributes['range'] == 'Month')
                        ranges: {
                            '{{ __('omega::component.date_picker.Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').startOf('month')],
                            '{{ __('omega::component.date_picker.Today') }}': [moment()],
                            '{{ __('omega::component.date_picker.Next Month') }}': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').startOf('month')]
                        },
                    @endif
                @else
                    ranges: {
                        '{{ __('omega::component.date_picker.Last Year') }}': [moment().startOf('year'), moment().startOf('year')],
                        '{{ __('omega::component.date_picker.Last Month') }}': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').startOf('month')],
                        '{{ __('omega::component.date_picker.Today') }}': [moment()],
                        '{{ __('omega::component.date_picker.Next Month') }}': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').startOf('month')],
                        '{{ __('omega::component.date_picker.Next Year') }}': [moment().add(1, 'year').startOf('year'), moment().add(1, 'year').startOf('year')]
                    },
                @endif
                locale: {
                    cancelLabel: '{{ __('omega::misc.button.Clear') }}',
                    applyLabel: '{{ __('omega::misc.button.Apply') }}',
                    format: 'DD.MM.YYYY',
                    daysOfWeek: [
                        '{{ __('omega::misc.datetime.Su') }}',
                        '{{ __('omega::misc.datetime.Mo') }}',
                        '{{ __('omega::misc.datetime.Tu') }}',
                        '{{ __('omega::misc.datetime.We') }}',
                        '{{ __('omega::misc.datetime.Th') }}',
                        '{{ __('omega::misc.datetime.Fr') }}',
                        '{{ __('omega::misc.datetime.Sa') }}',
                    ],
                    monthNames: [
                        '{{ __('omega::misc.datetime.January') }}',
                        '{{ __('omega::misc.datetime.February') }}',
                        '{{ __('omega::misc.datetime.March') }}',
                        '{{ __('omega::misc.datetime.April') }}',
                        '{{ __('omega::misc.datetime.May') }}',
                        '{{ __('omega::misc.datetime.June') }}',
                        '{{ __('omega::misc.datetime.July') }}',
                        '{{ __('omega::misc.datetime.August') }}',
                        '{{ __('omega::misc.datetime.September') }}',
                        '{{ __('omega::misc.datetime.October') }}',
                        '{{ __('omega::misc.datetime.November') }}',
                        '{{ __('omega::misc.datetime.December') }}',
                    ],
                    firstDay: 1
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
