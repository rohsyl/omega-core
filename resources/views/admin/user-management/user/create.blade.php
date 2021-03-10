@extends('omega::admin.layouts.admin')

@section('page-header')
    Add user
@endsection


@section('large-card-title')
@endsection

@section('large-card-content')
    {{ Form::open(['route' => 'omega.admin.users.store']) }}

        <div class="mb-3">
            {{ Form::label('email', __('E-Mail Address'), ['class' => 'form-label']) }}
            {{ Form::email('email', null, ['class' => 'form-control']) }}
        </div>

        <div class="mb-3">
            {{ Form::label('fullname', __('Fullname'), ['class' => 'form-label']) }}
            {{ Form::text('fullname', null, ['class' => 'form-control']) }}
        </div>

        <div class="mb-3">
            {{ Form::label('password', __('Password'), ['class' => 'form-label']) }}
            {{ Form::password('password', ['class' => 'form-control']) }}
        </div>

        <div class="mb-3 form-check">
            {{ Form::checkbox('is-enabled', 'value', true, ['class' => 'form-check-input']) }}
            {{ Form::label('is-enabled', __('Enable user?'), ['class' => 'form-check-label']) }}
        </div>

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