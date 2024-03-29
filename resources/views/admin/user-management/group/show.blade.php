@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Groups') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.groups.index') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.groups.edit', $group) }}"><i class="fas fa-edit"></i> {{ __('Edit group') }}</a>
    @if (!$group->is_system)
        {{ Form::odelete(route('omega.admin.groups.destroy', $group), ['class' => 'btn btn-outline-danger btn-sm', 'label' => __('Delete group')]) }}
    @endif
@endsection

@section('content')


    <x-oix-card title="{{ __('Group') }}" subtitle="{{ __('Group informations.') }}">
        {{ Form::oattribute(__('Name'), $group->name) }}
        {{ Form::oattribute(__('Description'), $group->description) }}
        {{ Form::oattribute(__('Group enabled '), $group->is_enabled ? __('Yes') : __('No')) }}
    </x-oix-card>

    <x-oix-card title="{{ __('Permissions') }}" subtitle="{{ __('Group permissions.') }}">
        <div style="max-height: 300px; overflow-y: scroll">
            {{ Form::opermissions('permissions', $permissions, $group, ['readonly' => true, 'label_prefix' => 'omega::label.acl_.']) }}
        </div>
    </x-oix-card>

    <x-oix-card title="{{ __('User') }}" subtitle="{{ __('User in this group.') }}">
        <table class="table table-sm">
            @forelse($group->users as $user)
                <tr>
                    <td>
                        <a href="{{ route('omega.admin.users.show', $user) }}"><i class="fas fa-eye"></i></a>
                        {{ $user->fullname }} - {{ $user->email }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-muted text-sm">{{ __('No members...') }}</td>
                </tr>
            @endforelse
        </table>
    </x-oix-card>
@endsection