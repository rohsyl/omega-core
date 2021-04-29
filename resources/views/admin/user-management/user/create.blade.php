@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.users.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
@endsection

@section('content')

    {{ Form::open(['route' => 'omega.admin.users.store']) }}
    <x-oix-card title="User" subtitle="Create a new user.">

        {{ Form::oemail('email', null, ['label' => __('E-Mail Address')]) }}
        {{ Form::otext('fullname', null, ['label' => __('Fullname')]) }}
        {{ Form::opassword('password', ['label' => __('Password')]) }}
        {{ Form::opassword('repeat_password', ['no-label' => true]) }}
        {{ Form::ocheckbox('is_enabled', true, ['label' => __('Enable user?')]) }}

        {{ Form::oback() }}
        {{ Form::submit(__('Add user'), ['class' => 'btn btn-primary']) }}

    </x-oix-card>
    {{ Form::close() }}

@endsection