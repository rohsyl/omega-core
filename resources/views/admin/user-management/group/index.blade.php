@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users & Groups Management') }}
@endsection

@section('actions')
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.users.create') }}"><i class="fas fa-plus"></i> {{ __('Add user') }}</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.groups.create') }}"><i class="fas fa-plus"></i> {{ __('Add groups') }}</a>
@endsection

@section('content')

    @include('omega::admin.user-management.sub._menu', ['active' => 'groups'])

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" width="10"></th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Users') }}</th>
                    <th scope="col" class="text-center">{{ __('Enabled') }}</th>
                    <th scope="col" class="text-center">{{ __('System') }}</th>
                    <th scope="col" class="text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($groups as $group)
                    <tr>
                        <td scope="row">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="groups-select-{{ $group->id }}">
                                <label class="custom-control-label" for="group-select-{{ $group->id }}"></label>
                            </div>
                        </td>
                        <td>{{ $group->name}}</td>
                        <td>{{ $group->users->count()}}</td>
                        <td class="text-center">
                            @if ($group->is_enabled)
                                <i class="fas fa-check-circle color-green"></i>
                            @else
                                <i class="fas fa-times-circle color-red-light"></i>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($group->is_system)
                                <i class="fas fa-check-circle color-blue"></i>
                            @else
                                <i class="fas fa-times-circle"></i>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('omega.admin.groups.show', $group) }}"><i class="fas fa-eye"></i></a>
                            &nbsp;|&nbsp;
                            <a href="{{ route('omega.admin.groups.edit', $group) }}"><i class="fas fa-edit"></i></a>
                            @if (!$group->is_system)
                            &nbsp;|&nbsp;
                            {{ Form::odelete(route('omega.admin.groups.destroy', $group), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'fas fa-trash']) }}
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection






