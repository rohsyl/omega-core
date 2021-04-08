@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Menus') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Create menu') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.appearance.menus.store'), 'method' => 'post']) }}

                {{ Form::otext('name', null, ['label' => __('Title')]) }}
                {{ Form::otextarea('description', null, ['label' => __('Description')]) }}

                {{ Form::oback() }}
                {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>

@endsection

