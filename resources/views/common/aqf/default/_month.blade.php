<div class="card">
    <div class="card-body">
        @php
            $selected = request()->has('m') && isset(request()->m[$name]) ? request()->m[$name] : [];
            $selectedMonth = $selected['m'] ?? (isset($date) ? $date->month : null) ?? \Illuminate\Support\Carbon::today()->month;
            $selectedYear = $selected['y'] ?? (isset($date) ? $date->year : null) ?? \Illuminate\Support\Carbon::today()->year;
            $years = range(1999, \Illuminate\Support\Carbon::today()->year);
            $years = array_combine($years, $years);
            $months = [];
            foreach(range(1, 12) as $i) {
                $months[$i] = \Illuminate\Support\Carbon::create($selectedYear, $i, 1)->format('F');
            }
        @endphp
        <label>Month</label>
        <div class="row gutters-tiny">
            <div class="col-md-8">
                {{ Form::select('m['.$name.'][m]', $months, $selectedMonth, ['class' => 'form-control']) }}
            </div>
            <div class="col-md-4">
                {{ Form::select('m['.$name.'][y]', $years, $selectedYear, ['class' => 'form-control']) }}
            </div>
        </div>
    </div>
</div>
