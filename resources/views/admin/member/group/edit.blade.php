@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Member groups') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.groups.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.member.groups.update', $group), 'method' => 'put']) }}


    <x-oix-card title="Member group" subtitle="Edit member group informations.">
        {{ Form::otext('name', $group->name, ['label' => __('Name'), 'autocomplete' => 'off']) }}
    </x-oix-card>

    <x-oix-card title="Permissions" subtitle="Manage member permissions.">

        <p class="mb-1">Permissions</p>
        {{ Form::opermissions('permissions', $permissions, $group, ['acls' => 'members']) }}

    </x-oix-card>

    <x-oix-card title="Member groups" subtitle="Assign member to groups.">
        {{ Form::oselectmultiple('members', $members, $group->members, ['label' => _('Members')]) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}
@endsection
