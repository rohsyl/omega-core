@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Menus') }}
@endsection

@section('left-small-card-content')
@endsection

@section('large-card-content')

    {{ Form::oback() }}

    <div class="card">
        <div class="card-header">
            {{ __('Create menu') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.appearance.menus.store'), 'method' => 'post']) }}

                {{ Form::otext('name', null, ['label' => __('Title')]) }}
                {{ Form::otextarea('description', null, ['label' => __('Description')]) }}

                {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>


@endsection

