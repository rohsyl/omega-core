@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Groups') }}
@endsection


@section('actions')
    <a class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> {{ __('Edit users') }}</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Edit') . ' ' . $group->name }}
        </div>
        <div class="card-body">
            {{ Form::open(['route' => ['omega.admin.groups.update', $group], 'method' => 'put']) }}



            {{ Form::otext('name', $group->name, ['label' => __('Name')]) }}
            {{ Form::otext('description', $group->description, ['label' => __('Description')]) }}
            {{ Form::ocheckbox('is-enabled', $group->is_enabled, ['label' => __('Enable group?')]) }}

            {{ Form::oback() }}
            {{ Form::submit(__('Edit group'), ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>
@endsection