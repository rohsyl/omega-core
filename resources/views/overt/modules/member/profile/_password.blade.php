
<x-oix-card title="{{ __('Password') }}" subtitle="{{ __('Change your password.') }}">

    {{ Form::open(['url' => route('overt.module.member.profile.password.update', auth('member')->user()), 'method' => 'put']) }}
    {{ Form::opassword('password', ['label' => __('Password'), 'autocomplete' => 'off']) }}
    {{ Form::opassword('repeat_password', ['label' => __('Confirm password'), 'autocomplete' => 'off']) }}
    {{ Form::oback() }}
    {{ Form::osubmit() }}
    {{ Form::close() }}
</x-oix-card>