@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Groups') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.groups.show', $group) }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
@endsection

@section('content')


    {{ Form::open(['route' => ['omega.admin.groups.update', $group], 'method' => 'put']) }}

    <x-oix-card title="{{ __('Group') }}" subtitle="{{ __('Edit group informations.') }}">

        {{ Form::otext('name', $group->name, ['label' => __('Name'), 'readonly' => $group->is_system]) }}
        {{ Form::otext('description', $group->description, ['label' => __('Description'), 'readonly' => $group->is_system]) }}
        {{ Form::ocheckbox('is_enabled', $group->is_enabled, ['label' => __('Enable group?')]) }}
    </x-oix-card>

    <x-oix-card title="{{ __('Permissions') }}" subtitle="{{ __('Manage member permissions.') }}">

        <p class="mb-1">{{ __('Permissions') }}</p>
        {{ Form::opermissions('permissions', $permissions, $group) }}

    </x-oix-card>

    <x-oix-card title="{{ __('Member groups') }}" subtitle="{{ __('Assign member to groups.') }}">
        {{ Form::oselectmultiple('users', $users, $group->users, ['label' => _('Users')]) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}
@endsection