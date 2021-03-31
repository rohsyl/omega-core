@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Add user') }}
@endsection


@section('large-card-title')
@endsection

@section('large-card-content')
    {{ Form::open(['route' => 'omega.admin.users.store']) }}


        {{ Form::oemail('email', null, ['label' => __('E-Mail Address')]) }}
        {{ Form::otext('fullname', null, ['label' => __('Fullname')]) }}
        {{ Form::opassword('password', ['label' => __('Password')]) }}
        {{ Form::ocheckbox('is-enabled', true, ['label' => __('Enable user?')]) }}

        {{ Form::oback() }}
        {{ Form::submit(__('Add user'), ['class' => 'btn btn-primary']) }}


    {{ Form::close() }}
@endsection


@section('left-small-card-title')
@endsection

@section('left-small-card-content')
@endsection


@section('right-small-card-title')
@endsection

@section('right-small-card-content')
@endsection