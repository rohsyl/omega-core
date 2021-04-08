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

    <div class="card">
        <div class="card-header">
            {{ $user->fullname }}
        </div>
        <div class="card-body">
            {{ Form::oattribute(__('E-Mail Address'), $user->email) }}
            {{ Form::oattribute(__('Fullname'), $user->fullname) }}
            {{ Form::oattribute(__('User enabled '), !$user->is_disabled ? __('Yes') : __('No')) }}
        </div>
    </div>


@endsection