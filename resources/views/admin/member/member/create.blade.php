@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.members.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.member.members.store'), 'method' => 'post']) }}
    <x-oix-card title="Member" subtitle="Create a new member.">

        {{ Form::otext('username', null, ['label' => __('Username'), 'autocomplete' => 'off']) }}
        {{ Form::otext('email', null, ['label' => __('E-mail'), 'autocomplete' => 'off']) }}
        {{ Form::opassword('password', ['label' => __('Password'), 'autocomplete' => 'off']) }}

        {{ Form::oback() }}
        {{ Form::osubmit() }}

    </x-oix-card>
    {{ Form::close() }}

@endsection
