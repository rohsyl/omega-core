@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Edit') . $group->name }}
@endsection


@section('large-card-title')
@endsection

@section('large-card-content')
    {{ Form::open(['route' => ['omega.admin.groups.update', $group], 'method' => 'put']) }}



        {{ Form::otext('name', $group->name, ['label' => __('Name')]) }}
        {{ Form::otext('description', $group->description, ['label' => __('Description')]) }}
        {{ Form::ocheckbox('is-enabled', $group->is_enabled, ['label' => __('Enable group?')]) }}

        {{ Form::oback() }}
        {{ Form::submit(__('Edit group'), ['class' => 'btn btn-primary']) }}

    {{ Form::close() }}
@endsection


@section('left-small-card-title')
    <h5>{{ __('Users') }}</h5>
@endsection

@section('left-small-card-content')
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-primary col">{{ __('Edit users') }}</a>
        </div>
    </div>
@endsection


@section('right-small-card-title')
@endsection

@section('right-small-card-content')
@endsection