@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Edit') . $user->fullname }}
@endsection


@section('large-card-title')
@endsection

@section('large-card-content')
    {{ Form::open(['route' => ['omega.admin.users.update', $user], 'method' => 'put']) }}


        {{ Form::oemail('email', $user->email, ['label' => __('E-Mail Address')]) }}
        {{ Form::otext('fullname', $user->fullname, ['label' => __('Fullname')]) }}
        {{ Form::ocheckbox('is-enabled', !$user->is_disabled, ['label' => __('Enable user?')]) }}

        {{ Form::oback() }}
        {{ Form::submit(__('Edit user'), ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}
@endsection


@section('left-small-card-title')
    <h5>{{ __('Password') }}</h5>
@endsection

@section('left-small-card-content')
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-primary col">{{ __('Send reset link') }}</a>
        </div>
        <div class="col">
            <a class="btn btn-outline-secondary col">{{ __('Edit password') }}</a>
        </div>
    </div>
@endsection


@section('right-small-card-title')
    <h5>{{ __('Groups') }}</h5>
@endsection

@section('right-small-card-content')
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-primary col">{{ __('Edit groups') }}</a>
        </div>
    </div>
@endsection