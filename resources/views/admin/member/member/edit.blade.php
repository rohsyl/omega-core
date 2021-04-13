@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Update member') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.member.members.update', $member), 'method' => 'put']) }}

            {{ Form::otext('username', $member->username, ['label' => __('Username'), 'autocomplete' => 'off']) }}
            {{ Form::otext('email', $member->email, ['label' => __('E-mail'), 'autocomplete' => 'off']) }}

            {{ Form::oback() }}
            {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>
@endsection
