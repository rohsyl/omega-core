@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Add group') }}
@endsection


@section('large-card-title')
@endsection

@section('large-card-content')
    {{ Form::open(['route' => 'omega.admin.groups.store']) }}


        {{ Form::otext('name', null, ['label' => __('Name')]) }}
        {{ Form::otext('description', null, ['label' => __('Description')]) }}
        {{ Form::ocheckbox('is-enabled', true, ['label' => __('Enable group?')]) }}

        {{ Form::oback() }}
        {{ Form::submit(__('Add group'), ['class' => 'btn btn-primary']) }}

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