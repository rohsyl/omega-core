@extends('omega::admin.default')

@section('page-header')
    {{ __('Pages') }}
@endsection

@section('actions')
@endsection

@section('content')

    {{ Form::oback() }}

    <div class="card">
        <div class="card-header">
            {{ __('Create page') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.content.pages.store'), 'method' => 'post']) }}

                {{ Form::otext('title', null, ['label' => __('Title')]) }}

                {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>


@endsection

