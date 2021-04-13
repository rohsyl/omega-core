@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection

@section('actions')
    <a href="{{ route('omega.admin.member.members.create') }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-plus"></i>
        {{ __('Add member') }}
    </a>
    <a href="{{ route('omega.admin.member.groups.create') }}" class="btn btn-sm btn-outline-primary">
        <i class="fas fa-plus"></i>
        {{ __('Add group') }}
    </a>
@endsection

@section('content')

    @include('omega::admin.member.sub._menu', ['active' => 'members'])

    <div class="card">
        <div class="card-body">

            <table class="table">
                <tr>
                    <th>{{ __('Username') }}</th>
                    <th>{{ __('E-Mail') }}</th>
                    <th>{{ __('Enabled') }}</th>
                    <th>{{ __('Validated') }}</th>
                    <th></th>
                </tr>
                @forelse($members as $member)
                    <tr>
                        <td>
                            <a href="{{ route('omega.admin.member.members.show', $member) }}">{{ $member->username }}</a>
                        </td>
                        <td>{{ $member->email }}</td>
                        <td>
                            @if ($member->is_enabled)
                                <i class="fas fa-check-circle color-green"></i>
                            @else
                                <i class="fas fa-times-circle color-red-light"></i>
                            @endif
                        </td>
                        <td>
                            @if ($member->is_validated)
                                <i class="fas fa-check-circle color-green"></i>
                            @else
                                <i class="fas fa-times-circle color-red-light"></i>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('omega.admin.member.members.show', $member) }}"><i class="fas fa-eye"></i></a>
                            &nbsp;|&nbsp;
                            <a href="{{ route('omega.admin.member.members.edit', $member) }}"><i class="fas fa-edit"></i></a>
                            &nbsp;|&nbsp;
                            {{ Form::odelete(route('omega.admin.member.members.destroy', $member), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'fas fa-trash']) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            {{ __('No members ...') }}
                        </td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
@endsection
