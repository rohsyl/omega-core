@if(!isset($inline) || !$inline)
<div class="block">
    <div class="block-content pt-3">
@endif

    @if(!isset($inline) || !$inline)
    {{ Form::label('between['.$name.']', $label ?? __('label.range_between')) }}
    @endif
    <div class="row gutters-tiny">
        <div class="col-sm-6">
            {{ Form::onumber('between['.$name.'][min]', $min ?? null, null, ['placeholder' => 'Min', 'no-label' => true]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::onumber('between['.$name.'][max]', $max ?? null, null, ['placeholder' => 'Max', 'no-label' => true]) }}
        </div>
    </div>


@if(!isset($inline) || !$inline)
    </div>
</div>
@endif
