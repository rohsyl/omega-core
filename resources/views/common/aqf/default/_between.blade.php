@if(!isset($inline) || !$inline)
<div class="card">
    <div class="card-body p-15">
@endif

    @if(!isset($inline) || !$inline)
    {{ Form::label('between['.$name.']', $label ?? __('Between')) }}
    @endif
    <div class="row gutters-tiny">
        <div class="col-sm-6">
            {{ Form::number('between['.$name.'][min]', $min ?? null, null, ['placeholder' => __('Min')]) }}
        </div>
        <div class="col-sm-6">
            {{ Form::number('between['.$name.'][max]', $max ?? null, null, ['placeholder' => __('Max')]) }}
        </div>
    </div>


@if(!isset($inline) || !$inline)
    </div>
</div>
@endif
