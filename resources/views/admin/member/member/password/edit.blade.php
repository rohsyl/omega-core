@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.members.show', $member) }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.member.members.password.update', $member), 'method' => 'put']) }}

    <x-oix-card title="{{ __('Member') }}" subtitle="{{ __('Edit member password for :username', ['username' => $member->username]) }}.">
        {{ Form::opassword('password', ['label' => __('Password'), 'autocomplete' => 'off']) }}
        {{ Form::opassword('repeat_password', ['no-label' => true, 'autocomplete' => 'off']) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}

@endsection
