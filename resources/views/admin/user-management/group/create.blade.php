@extends('omega::admin.layouts.admin')

@section('page-header')
    Add group
@endsection


@section('large-card-title')
@endsection

@section('large-card-content')
    {{ Form::open(['route' => 'omega.admin.groups.store']) }}

    <div class="mb-3">
        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
        {{ Form::text('name', null, ['class' => 'form-control']) }}
    </div>

    <div class="mb-3">
        {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
        {{ Form::text('description', null, ['class' => 'form-control']) }}
    </div>

    <div class="mb-3 form-check">
        {{ Form::checkbox('is-enabled', 'value', true, ['class' => 'form-check-input']) }}
        {{ Form::label('is-enabled', __('Enable group?'), ['class' => 'form-check-label']) }}
    </div>

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