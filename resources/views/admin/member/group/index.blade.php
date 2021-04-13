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

    @include('omega::admin.member.sub._menu', ['active' => 'groups'])

    <div class="card">
        <div class="card-body">

            <table class="table">
                <tr>
                    <th>{{ __('Name') }}</th>
                    <th></th>
                </tr>
                @forelse($groups as $group)
                    <tr>
                        <td>
                            <a href="{{ route('omega.admin.member.groups.show', $group) }}">{{ $group->name }}</a>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('omega.admin.member.groups.show', $group) }}"><i class="fas fa-eye"></i></a>
                            &nbsp;|&nbsp;
                            <a href="{{ route('omega.admin.member.groups.edit', $group) }}"><i class="fas fa-edit"></i></a>
                            &nbsp;|&nbsp;
                            {{ Form::odelete(route('omega.admin.member.groups.destroy', $group), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'fas fa-trash']) }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">
                            {{ __('No groups ...') }}
                        </td>
                    </tr>
                @endforelse
            </table>

        </div>
    </div>
@endsection
