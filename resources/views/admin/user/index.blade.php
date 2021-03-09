@extends('omega::admin.layouts.admin')
@section('page-header')
    Users & Groups Management
@endsection


@section('large-card-content')
    <ul class="nav nav-tabs" id="users-mgmt-tabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="users-mgmt-users-tab" data-bs-toggle="tab" data-bs-target="#users-mgmt-users" type="button" role="tab" aria-controls="users-mgmt-users" aria-selected="true">Users</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="users-mgmt-roles-tab" data-bs-toggle="tab" data-bs-target="#users-mgmt-roles" type="button" role="tab" aria-controls="users-mgmt-roles" aria-selected="true">Roles</button>
        </li>
    </ul>
    <div class="tab-content" id="users-mgmt-tab-contents">
        <div class="tab-pane fade show active" id="users-mgmt-users" role="tabpanel" aria-labelledby="users-mgmt-users-tab">
            @include('omega::admin.user.partials.user-tab')
        </div>
        <div class="tab-pane fade" id="users-mgmt-roles" role="tabpanel" aria-labelledby="users-mgmt-roles-tab">
            @include('omega::admin.user.partials.group-tab')
        </div>
    </div>
@endsection

@section('left-small-card-title')
    <h5>Users</h5>
@endsection
@section('left-small-card-content')
    <button class="btn btn-primary">Add User</button>
@endsection

@section('right-small-card-title')
    <h5>Groups</h5>
@endsection
@section('right-small-card-content')
    <button class="btn btn-primary">Add Groups</button>
@endsection
