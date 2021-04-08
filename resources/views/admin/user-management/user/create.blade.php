@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Create user') }}
        </div>
        <div class="card-body">
            {{ Form::open(['route' => 'omega.admin.users.store']) }}

            {{ Form::oemail('email', null, ['label' => __('E-Mail Address')]) }}
            {{ Form::otext('fullname', null, ['label' => __('Fullname')]) }}
            {{ Form::opassword('password', ['label' => __('Password')]) }}
            {{ Form::ocheckbox('is-enabled', true, ['label' => __('Enable user?')]) }}

            {{ Form::oback() }}
            {{ Form::submit(__('Add user'), ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>
@endsection