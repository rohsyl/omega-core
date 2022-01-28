<div class="card">
    <div class="card-body">
        @php
            $selected = request()->has('model') && isset(request()->model[$name]) ? request()->model[$name] : [];
        @endphp
        <div class="form-group">


        </div>
        @if (!isset($multiselect) || $multiselect)
            {{ Form::oselectmultiple('model['.$name.']', $list, $selected, ['label' => __('label.'.$name)]) }}
        @else
            {{ Form::oselect('model['.$name.']', $list, $selected, ['label' => __('label.'.$name)]) }}
        @endif
    </div>
</div>
