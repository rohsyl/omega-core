@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Member groups') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.groups.index') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.member.groups.update', $group), 'method' => 'put']) }}


    <x-oix-card title="{{ __('Member group') }}" subtitle="{{ __('Edit member group informations.') }}">
        {{ Form::otext('name', $group->name, ['label' => __('Name'), 'autocomplete' => 'off']) }}
    </x-oix-card>

    <x-oix-card title="{{ __('Permissions') }}" subtitle="{{ __('Manage member permissions.') }}">

        <p class="mb-1">{{ __('Permissions') }}</p>
        {{ Form::opermissions('permissions', $permissions, $group, ['acls' => 'members']) }}

    </x-oix-card>

    <x-oix-card title="{{ __('Member groups') }}" subtitle="{{ __('Assign member to groups.') }}">
        {{ Form::oselectmultiple('members', $members, $group->members, ['label' => __('Members')]) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}
@endsection
