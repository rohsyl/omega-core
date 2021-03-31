@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Pages') }}
@endsection

@section('left-small-card-content')
@endsection

@section('large-card-content')


    <div class="card">
        <div class="card-header">
            {{ __('Create page') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.content.pages.store'), 'method' => 'post']) }}

                {{ Form::otext('title', null, ['label' => __('Title')]) }}

                {{ Form::osubmit() }}
                {{ Form::oback() }}

            {{ Form::close() }}
        </div>
    </div>


@endsection

