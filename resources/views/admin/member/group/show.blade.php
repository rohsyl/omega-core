@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Member groups') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.groups.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.member.groups.edit', $group) }}"><i class="fas fa-edit"></i> {{ __('Edit group') }}</a>
    {{ Form::odelete(route('omega.admin.member.groups.destroy', $group), ['class' => 'btn btn-outline-danger btn-sm', 'label' => __('Delete group')]) }}
@endsection


@section('content')

    <x-oix-card title="Group" subtitle="Member group informations.">
        {{ Form::oattribute(__('Name'), $group->name) }}
    </x-oix-card>

    <x-oix-card title="Permissions" subtitle="Member group permissions.">
        <div style="max-height: 300px; overflow-y: scroll">
            {{ Form::opermissions('permissions', $permissions, $group, ['readonly' => true, 'acls' => 'members']) }}
        </div>
    </x-oix-card>

    <x-oix-card title="Member" subtitle="Member in this membergroup">
        <table class="table table-sm">
            @forelse($group->members as $member)
                <tr>
                    <td>
                        <a href="{{ route('omega.admin.member.members.show', $member) }}"><i class="fas fa-eye"></i></a>
                        {{ $member->username }} - {{ $member->email }}
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
