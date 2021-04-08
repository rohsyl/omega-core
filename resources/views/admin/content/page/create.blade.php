@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Pages') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Create page') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.content.pages.store'), 'method' => 'post']) }}

                {{ Form::otext('title', null, ['label' => __('Title')]) }}

                {{ Form::oback() }}
                {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>

@endsection

