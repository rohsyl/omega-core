@extends('omega::admin.layouts.admin')

@section('page-header')
    Edit {{ $group->name }}
@endsection


@section('large-card-title')
@endsection

@section('large-card-content')
    {{ Form::open(['route' => ['omega.admin.groups.update', $group], 'method' => 'put']) }}

        <div class="mb-3">
            {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
            {{ Form::text('name', $group->name, ['class' => 'form-control']) }}
        </div>

        <div class="mb-3">
            {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
            {{ Form::text('description', $group->description, ['class' => 'form-control']) }}
        </div>

        <div class="mb-3 form-check">
            {{ Form::checkbox('is-enabled', 'value', $group->is_enabled, ['class' => 'form-check-input']) }}
            {{ Form::label('is-enabled', __('Enable group?'), ['class' => 'form-check-label']) }}
        </div>

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