@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Groups') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.groups.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
@endsection


@section('content')

    {{ Form::open(['route' => 'omega.admin.groups.store']) }}
    <x-oix-card title="Group" subtitle="Create a new group.">
        {{ Form::otext('name', null, ['label' => __('Name')]) }}
        {{ Form::otext('description', null, ['label' => __('Description')]) }}
        {{ Form::ocheckbox('is-enabled', true, ['label' => __('Enable group?')]) }}

        {{ Form::oback() }}
        {{ Form::submit(__('Add group'), ['class' => 'btn btn-primary']) }}
    </x-oix-card>
    {{ Form::close() }}
@endsection
