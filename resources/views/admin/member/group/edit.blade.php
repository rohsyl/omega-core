@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Member groups') }}
@endsection

@section('content')

    <div class="card">
        <div class="card-header">
            {{ __('Update group') }}
        </div>
        <div class="card-body">
            {{ Form::open(['url' => route('omega.admin.member.groups.update', $group), 'method' => 'put']) }}

            {{ Form::otext('name', $group->name, ['label' => __('Name'), 'autocomplete' => 'off']) }}

            {{ Form::oback() }}
            {{ Form::osubmit() }}

            {{ Form::close() }}
        </div>
    </div>
@endsection
