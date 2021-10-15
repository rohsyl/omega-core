{{ Form::ocheckbox('check['.$check.']', request()->has('check') && isset(request()->check[$check]) ? request()->check[$check] : $default, ['label' => $label]) }}
