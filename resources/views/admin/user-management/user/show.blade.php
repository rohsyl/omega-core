@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.users.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.users.edit', $user) }}"><i class="fas fa-edit"></i> {{ __('Edit user') }}</a>
    {{ Form::odelete(route('omega.admin.users.destroy', $user), ['class' => 'btn btn-outline-danger btn-sm', 'label' => __('Delete user')]) }}
@endsection

@section('content')

    <x-oix-card title="User" subtitle="User informations.">
        {{ Form::oattribute(__('E-Mail Address'), $user->email) }}
        {{ Form::oattribute(__('Fullname'), $user->fullname) }}
        {{ Form::oattribute(__('User enabled '), !$user->is_disabled ? __('Yes') : __('No')) }}
    </x-oix-card>

    <x-oix-card title="Permissions" subtitle="User permissions.">
        <div style="max-height: 300px; overflow-y: scroll">
            {{ Form::opermissions('permissions', $permissions, $user, ['readonly' => true]) }}
        </div>
    </x-oix-card>

    <x-oix-card title="Member groups" subtitle="Groups to which the user belongs.">
        <table class="table table-sm">
            @forelse($user->groups as $group)
                <tr>
                    <td><a href="{{ route('omega.admin.groups.show', $group) }}"><i class="fas fa-eye"></i></a> {{ $group->name }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-muted text-sm">{{ __('No groups...') }}</td>
                </tr>
            @endforelse
        </table>
    </x-oix-card>

@endsection