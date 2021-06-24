@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Users & Groups Management') }}
@endsection

@section('actions')
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.users.create') }}"><i class="fas fa-plus"></i> {{ __('Add user') }}</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.groups.create') }}"><i class="fas fa-plus"></i> {{ __('Add groups') }}</a>
@endsection



@section('content')

    @include('omega::admin.user-management.sub._menu', ['active' => 'users'])

    <div class="card">
        <div class="card-body">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col" width="10"></th>
                    <th scope="col">{{ __('Fullname') }}</th>
                    <th scope="col">{{ __('Email') }}</th>
                    <th scope="col" class="text-center">{{ __('Enabled') }}</th>
                    <th scope="col" class="text-right">{{ __('Actions') }}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td scope="row">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="user-select-{{ $user->id }}">
                                <label class="custom-control-label" for="user-select-{{ $user->id }}"></label>
                            </div>
                        </td>
                        <td>{{ $user->fullname }}</td>
                        <td>{{ $user->email }}</td>
                        <td  class="text-center">
                            @if ($user->is_disabled)
                                <i class="fas fa-times-circle color-red-light"></i>
                            @else
                                <i class="fas fa-check-circle color-green"></i>
                            @endif
                        </td>
                        <td class="text-right">
                            <a href="{{ route('omega.admin.users.show', $user) }}"><i class="fas fa-eye"></i></a>
                            &nbsp;|&nbsp;
                            <a href="{{ route('omega.admin.users.edit', $user) }}"><i class="fas fa-edit"></i></a>
                            &nbsp;|&nbsp;
                            {{ Form::odelete(route('omega.admin.users.destroy', $user), ['class' => 'btn btn-link m-0 pt-0 px-0 pb-1 color-red', 'icon' => 'fas fa-trash']) }}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection



