@extends('omega::admin.layouts.default')

@section('page-header')
    Users & Groups Management
@endsection

@section('actions')
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.users.create') }}"><i class="fas fa-plus"></i> {{ __('Add user') }}</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.groups.create') }}"><i class="fas fa-plus"></i> {{ __('Add groups') }}</a>
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <ul class="nav nav-tabs" id="users-mgmt-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="users-mgmt-users-tab" data-toggle="tab" data-target="#users-mgmt-users" type="button" role="tab" aria-controls="users-mgmt-users" aria-selected="true">Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="users-mgmt-groups-tab" data-toggle="tab" data-target="#users-mgmt-groups" type="button" role="tab" aria-controls="users-mgmt-groups" aria-selected="true">Groups</button>
                </li>
            </ul>
            <div class="tab-content" id="users-mgmt-tab-contents">
                <div class="tab-pane fade show active" id="users-mgmt-users" role="tabpanel" aria-labelledby="users-mgmt-users-tab">
                    @include('omega::admin.user-management.user.index-tab')
                </div>
                <div class="tab-pane fade" id="users-mgmt-groups" role="tabpanel" aria-labelledby="users-mgmt-groups-tab">
                    @include('omega::admin.user-management.group.index-tab')
                </div>
            </div>
        </div>
    </div>
@endsection
