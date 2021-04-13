@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Member groups') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Create group') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.member.groups.store'), 'method' => 'post']) }}

            {{ Form::otext('name', null, ['label' => __('Name'), 'autocomplete' => 'off']) }}

            {{ Form::oback() }}
            {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>
@endsection
