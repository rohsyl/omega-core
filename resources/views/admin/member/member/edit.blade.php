@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.members.index') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.member.members.update', $member), 'method' => 'put']) }}

    <x-oix-card title="{{ __('Member') }}" subtitle="{{ __('Edit member informations.') }}">
        {{ Form::otext('username', $member->username, ['label' => __('Username'), 'autocomplete' => 'off']) }}
        {{ Form::otext('email', $member->email, ['label' => __('E-mail'), 'autocomplete' => 'off']) }}
        {{ Form::ocheckbox('is_enabled', $member->is_enabled, ['label' => __('Is enabled'), 'autocomplete' => 'off']) }}
    </x-oix-card>

    <x-oix-card title="{{ __('Permissions') }}" subtitle="{{ __('Manage member permissions.') }}">

        <p class="mb-1">{{ __('Permissions') }}</p>
        {{ Form::opermissions('permissions', $permissions, $member, ['acls' => 'members']) }}
    </x-oix-card>

    <x-oix-card title="{{ __('Member groups') }}" subtitle="{{ __('Assign member to groups.') }}">
        {{ Form::oselectmultiple('membergroups', $membergroups, $member->membergroups, ['label' => __('Groups')]) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}

@endsection
