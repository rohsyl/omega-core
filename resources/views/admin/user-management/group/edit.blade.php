@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Groups') }}
@endsection


@section('actions')
    <a class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i> {{ __('Edit users') }}</a>
@endsection

@section('content')


    {{ Form::open(['route' => ['omega.admin.groups.update', $group], 'method' => 'put']) }}

    <x-oix-card title="Group" subtitle="Edit group informations.">

        {{ Form::otext('name', $group->name, ['label' => __('Name')]) }}
        {{ Form::otext('description', $group->description, ['label' => __('Description')]) }}
        {{ Form::ocheckbox('is_enabled', $group->is_enabled, ['label' => __('Enable group?')]) }}
    </x-oix-card>

    <x-oix-card title="Permissions" subtitle="Manage member permissions.">

        <p class="mb-1">Permissions</p>
        {{ Form::opermissions('permissions', $permissions, $group) }}

    </x-oix-card>

    <x-oix-card title="Member groups" subtitle="Assign member to groups.">
        {{ Form::oselectmultiple('users', $users, $group->users, ['label' => _('Users')]) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}
@endsection