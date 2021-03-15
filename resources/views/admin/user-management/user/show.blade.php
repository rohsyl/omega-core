@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ $user->fullname }}
@endsection


@section('large-card-title')
    {{ __('User informations') }}
@endsection

@section('large-card-content')
    @include('omega::layouts.partials.session-alert', ['type' =>'success'])

    {{ Form::open(['route' => 'omega.admin.users.store']) }}

    <div class="mb-3">
        {{ Form::label('email', __('E-Mail Address'), ['class' => 'form-label']) }}
        {{ Form::email('email', $user->email, ['class' => 'form-control', 'readonly']) }}
    </div>

    <div class="mb-3">
        {{ Form::label('fullname', __('Fullname'), ['class' => 'form-label']) }}
        {{ Form::text('fullname', $user->fullname, ['class' => 'form-control', 'readonly']) }}
    </div>

    <div class="mb-3">
        {{ Form::label('password', __('Password'), ['class' => 'form-label']) }}
        {{ Form::text('password', "********", ['class' => 'form-control', 'readonly']) }}
    </div>

    <div class="mb-3 form-check">
        {{ Form::checkbox('is-enabled', null, !$user->is_disabled, ['class' => 'form-check-input', 'onclick="event.preventDefault();"']) }}
        {{ Form::label('is-enabled', __('Enabled user?'), ['class' => 'form-check-label']) }}
    </div>

    {{ Form::close() }}
@endsection


@section('left-small-card-title')
    <h5>{{ __('Edit') }}</h5>
@endsection

@section('left-small-card-content')
    <div class="row">
        <div class="col">
            <a class="btn btn-outline-primary col" href="{{ route('omega.admin.users.edit', $user) }}">{{ __('Edit user') }}</a>
        </div>
        <div class="col">
            <a class="btn btn-outline-secondary col">{{ __('Edit user groups') }}</a>
        </div>
    </div>
@endsection


@section('right-small-card-title')
    <h5>{{ __('Delete') }}</h5>
@endsection

@section('right-small-card-content')
    <div class="row">
        <div class="col">
            {{ Form::odelete(route('omega.admin.users.destroy', $user), ['class' => 'btn btn-outline-danger col', 'label' => __('Delete user')]) }}
        </div>
    </div>
@endsection