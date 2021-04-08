@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Create member') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.member.members.store'), 'method' => 'post']) }}

            {{ Form::otext('username', null, ['label' => __('Username'), 'autocomplete' => 'off']) }}
            {{ Form::otext('email', null, ['label' => __('E-mail'), 'autocomplete' => 'off']) }}
            {{ Form::opassword('password', ['label' => __('Password'), 'autocomplete' => 'off']) }}

            {{ Form::oback() }}
            {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>
@endsection
