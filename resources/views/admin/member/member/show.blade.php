@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.members.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.member.members.edit', $member) }}"><i class="fas fa-edit"></i> {{ __('Edit member') }}</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.member.members.password.edit', $member) }}"><i class="fas fa-key"></i> {{ __('Edit password') }}</a>
    {{ Form::odelete(route('omega.admin.member.members.destroy', $member), ['class' => 'btn btn-outline-danger btn-sm', 'label' => __('Delete mbmer')]) }}
@endsection


@section('content')

    <x-oix-card title="Member" subtitle="Member informations.">
        {{ Form::oattribute(__('Username'), $member->username) }}
        {{ Form::oattribute(__('E-Mail'), $member->email) }}
        {{ Form::oattribute(__('Member enabled '), $member->is_enabled ? __('Yes') : __('No')) }}
        {{ Form::oattribute(__('Validated at'), $member->validated_at) }}
    </x-oix-card>

    <x-oix-card title="Permissions" subtitle="Member permissions.">
        <div style="max-height: 300px; overflow-y: scroll">
            {{ Form::opermissions('permissions', $permissions, $member, ['readonly' => true, 'acls' => 'members']) }}
        </div>
    </x-oix-card>

    <x-oix-card title="Member groups" subtitle="Groups to which the user belongs.">
        <table class="table table-sm">
            @forelse($member->membergroups as $group)
                <tr>
                    <td><a href="{{ route('omega.admin.member.groups.show', $group) }}"><i class="fas fa-eye"></i></a> {{ $group->name }}</td>
                </tr>
            @empty
                <tr>
                    <td class="text-muted text-sm">{{ __('No groups...') }}</td>
                </tr>
            @endforelse
        </table>
    </x-oix-card>

@endsection
