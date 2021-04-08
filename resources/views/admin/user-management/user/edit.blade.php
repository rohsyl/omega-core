@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users') }}
@endsection

@section('actions')

    <div class="btn-group">
        <a class="btn btn-outline-primary btn-sm"><i class="fas fa-key"></i> {{ __('Edit password') }}</a>
        <a class="btn btn-outline-primary btn-sm"><i class="fas fa-envelope"></i> {{ __('Send reset link') }}</a>
    </div>

    <a class="btn btn-outline-primary btn-sm"><i class="fas fa-users"></i> {{ __('Edit groups') }}</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Edit') . ' ' . $user->fullname }}
        </div>
        <div class="card-body">
            {{ Form::open(['route' => ['omega.admin.users.update', $user], 'method' => 'put']) }}


            {{ Form::oemail('email', $user->email, ['label' => __('E-Mail Address')]) }}
            {{ Form::otext('fullname', $user->fullname, ['label' => __('Fullname')]) }}
            {{ Form::ocheckbox('is-enabled', !$user->is_disabled, ['label' => __('Enable user?')]) }}

            {{ Form::oback() }}
            {{ Form::submit(__('Edit user'), ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>
@endsection
