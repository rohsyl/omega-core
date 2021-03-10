@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ $group->name }}
@endsection


@section('large-card-title')
    {{ __('Group informations') }}
@endsection

@section('large-card-content')
    @include('omega::layouts.partials.session-alert', ['type' =>'success'])

    {{ Form::open(['route' => 'omega.admin.users.store']) }}


    <div class="mb-3">
        {{ Form::label('name', __('Name'), ['class' => 'form-label']) }}
        {{ Form::text('name', $group->name, ['class' => 'form-control', 'readonly']) }}
    </div>

    <div class="mb-3">
        {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
        {{ Form::text('description', $group->description, ['class' => 'form-control', 'readonly']) }}
    </div>

    <div class="mb-3 form-check">
        {{ Form::checkbox('is-enabled', null, $group->is_enabled, ['class' => 'form-check-input', 'onclick="event.preventDefault();"']) }}
        {{ Form::label('is-enabled', __('Enabled group?'), ['class' => 'form-check-label']) }}
    </div>

    {{ Form::close() }}
@endsection


@section('left-small-card-title')
    {{ __('Edit') }}
@endsection

@section('left-small-card-content')
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-primary col" href="{{ route('omega.admin.groups.edit', $group) }}">{{ __('Edit group') }}</a>
        </div>
        <div class="col">
            <a class="btn btn-outline-secondary col">{{ __('Edit group users') }}</a>
        </div>
    </div>
@endsection


@section('right-small-card-title')
    <h5>{{ __('Delete') }}</h5>
@endsection

@section('right-small-card-content')
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-danger col" href="{{ route('omega.admin.groups.destroy', $group) }}">{{ __('Delete group') }}</a>
        </div>
    </div>
@endsection