@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.members.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.member.members.update', $member), 'method' => 'put']) }}

    <x-oix-card title="Member" subtitle="Edit member informations.">
        {{ Form::otext('username', $member->username, ['label' => __('Username'), 'autocomplete' => 'off']) }}
        {{ Form::otext('email', $member->email, ['label' => __('E-mail'), 'autocomplete' => 'off']) }}
        {{ Form::ocheckbox('is_enabled', $member->is_enabled, ['label' => __('Is enabled'), 'autocomplete' => 'off']) }}
    </x-oix-card>

    <x-oix-card title="Permissions" subtitle="Manage member permissions.">

        <p class="mb-1">Permissions</p>
        {{ Form::opermissions('permissions', $permissions, $member, ['acls' => 'members']) }}
    </x-oix-card>

    <x-oix-card title="Member groups" subtitle="Assign member to groups.">
        {{ Form::oselectmultiple('membergroups', $membergroups, $member->membergroups, ['label' => _('Groups')]) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}

@endsection
