<div class="form-group">
    {{ Form::label($name, $label) }}

    {{ Form::hidden('check['.$check.']', 0) }}
    {{ Form::checkbox('check['.$check.']', 1,  request()->has('check') && isset(request()->check[$check]) ? request()->check[$check] : $default, $attributes) }}
</div>
