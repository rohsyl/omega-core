@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Groups') }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ __('Create group') }}
        </div>
        <div class="card-body">

            {{ Form::open(['route' => 'omega.admin.groups.store']) }}


            {{ Form::otext('name', null, ['label' => __('Name')]) }}
            {{ Form::otext('description', null, ['label' => __('Description')]) }}
            {{ Form::ocheckbox('is-enabled', true, ['label' => __('Enable group?')]) }}

            {{ Form::oback() }}
            {{ Form::submit(__('Add group'), ['class' => 'btn btn-primary']) }}

            {{ Form::close() }}
        </div>
    </div>
@endsection
