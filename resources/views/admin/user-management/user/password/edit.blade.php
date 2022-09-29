@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.users.show', $user) }}"><i class="fas fa-arrow-left"></i> Back</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.users.edit', $user) }}"><i class="fas fa-edit"></i> {{ __('Edit user') }}</a>
@endsection

@section('content')

    {{ Form::open(['route' => ['omega.admin.users.password.update', $user], 'method' => 'put']) }}

    <x-oix-card title="{{ __('User') }}" subtitle="{{ __('Edit user password for :username', ['username' => $user->fullname]) }}.">
        {{ Form::opassword('password', ['label' => __('Password'), 'autocomplete' => 'off']) }}
        {{ Form::opassword('repeat_password', ['no-label' => true, 'autocomplete' => 'off']) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}

@endsection
