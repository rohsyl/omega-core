@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.users.show', $user) }}"><i class="fas fa-arrow-left"></i> Back</a>
    <div class="btn-group">
        <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.users.password.edit', $user) }}"><i class="fas fa-key"></i> {{ __('Edit password') }}</a>
        <!--<a class="btn btn-outline-primary btn-sm"><i class="fas fa-envelope"></i> {{ __('Send reset link') }}</a>-->
    </div>
@endsection

@section('content')

    {{ Form::open(['route' => ['omega.admin.users.update', $user], 'method' => 'put']) }}

    <x-oix-card title="User" subtitle="Edit user informations.">

        {{ Form::oemail('email', $user->email, ['label' => __('E-Mail Address')]) }}
        {{ Form::otext('fullname', $user->fullname, ['label' => __('Fullname')]) }}
        {{ Form::ocheckbox('is_enabled', !$user->is_disabled, ['label' => __('Enable user?')]) }}

    </x-oix-card>

    <x-oix-card title="Permissions" subtitle="Manage user permissions.">

        <p class="mb-1">Permissions</p>
        {{ Form::opermissions('permissions', $permissions, $user) }}
    </x-oix-card>

    <x-oix-card title="User groups" subtitle="Assign user to groups.">
        {{ Form::oselectmultiple('groups', $groups, $user->groups, ['label' => _('Groups')]) }}
        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}

@endsection
