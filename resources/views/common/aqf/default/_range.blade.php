@if(!isset($inline) || !$inline)
<div class="card">
    <div class="card-body">
@endif
        <div class="row gutters-tiny">
            <div class="{{ isset($range_field) ? 'col-lg-6' : 'col-lg-12' }}">
                <div class="form-group mb-0">
                    @if(!isset($inline) || !$inline)
                        {{ Form::label('range_input', __('Range')) }}
                    @endif
                    <input type="text" id="range_input" autocomplete="off" class="form-control" />
                    {{ Form::hidden('range', $range, ['id' => 'range']) }}
                    <script type="text/javascript">
                        $(function () {
                            let range = $('#range').val();
                            let dates = range.split(',');
                            let start_date = dates[0];
                            let end_date = dates[1];
                            let $input = $('#range_input');
                            if(typeof start_date !== 'undefined' && start_date !== null && start_date.length > 0 &&
                                typeof end_date !== 'undefined' && end_date !== null && end_date.length
                            ) {
                                $input.val(start_date + ' ' + end_date);
                            }
                            $input
                                .daterangepicker({
                                    startDate: typeof start_date !== 'undefined' && start_date !== null && start_date.length > 0 ? start_date : moment,
                                    endDate: typeof end_date !== 'undefined' && end_date !== null && end_date.length > 0 ? end_date : moment,
                                    autoApply: true,
                                    @if(!isset($start) || !isset($end))
                                    autoUpdateInput: false,
                                    @endif
                                    opens: 'lefts',
                                    ranges: {
                                        @if(isset($config_ranges))
                                            {{ $config_ranges }}
                                        @endif
                                        'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                                        'This Year': [moment().startOf('year'), moment().endOf('year')],
                                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                                        'Next Year': [moment().add(1, 'year').startOf('year'), moment().add(1, 'year').endOf('year')],
                                        'Next Month': [moment().add(1, 'month').startOf('month'), moment().add(1, 'month').endOf('month')],
                                    },
                                    locale: {
                                        cancelLabel: 'Clear',
                                        format: 'DD.MM.YYYY',
                                    }
                                })
                                .on('apply.daterangepicker', function(ev, picker) {
                                    $('#range').val(picker.startDate.format('DD.MM.YYYY') + ',' + picker.endDate.format('DD.MM.YYYY'));
                                    $(this).val(picker.startDate.format('DD.MM.YYYY') + ' ' + picker.endDate.format('DD.MM.YYYY'));
                                })
                                @if(!isset($start) || !isset($end))
                                .change(function(e) {
                                    if($(this).val().length === 0) {
                                        $('#range').val('');
                                    }
                                })
                            @endif
                            ;


                        });
                    </script>
                </div>
            </div>
            @if (isset($range_field))
                @php
                    $selected = $value[3] ?? [];
                @endphp
                <div class="col-lg-6">
                    {{ Form::oselect('range_field', $range_field, $selected, ['label' => __('Searchable range field')]) }}
                </div>
            @endif
        </div>

@if(!isset($inline) || !$inline)
    </div>
</div>
@endif
