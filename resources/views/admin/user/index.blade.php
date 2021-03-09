@extends('omega::admin.default')
@section('page-header')
    Users Management
@endsection
@section('content')

    <div class="card text-center">
        <div class="card-header">

            <ul class="nav nav-tabs card-header-tabs" id="users-mgmt-tabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="users-mgmt-users-tab" data-bs-toggle="tab" data-bs-target="#users-mgmt-users" type="button" role="tab" aria-controls="users-mgmt-users" aria-selected="true">Users</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="users-mgmt-roles-tab" data-bs-toggle="tab" data-bs-target="#users-mgmt-roles" type="button" role="tab" aria-controls="users-mgmt-roles" aria-selected="true">Roles</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="users-mgmt-permissions-tab" data-bs-toggle="tab" data-bs-target="#users-mgmt-permissions" type="button" role="tab" aria-controls="users-mgmt-permissions" aria-selected="true">Permissions</button>
                </li>
            </ul>

        </div>
        <div class="card-body tab-content text-left" id="users-mgmt-tab-contents">

            <div class="tab-pane fade show active" id="users-mgmt-users" role="tabpanel" aria-labelledby="users-mgmt-users-tab">
                @include('omega::admin.user.partials.user-tab')
            </div>
            <div class="tab-pane fade" id="users-mgmt-roles" role="tabpanel" aria-labelledby="users-mgmt-roles-tab">
                @include('omega::admin.user.partials.role-tab')
            </div>
            <div class="tab-pane fade" id="users-mgmt-permissions" role="tabpanel" aria-labelledby="users-mgmt-permissions-tab">
                @include('omega::admin.user.partials.permission-tab')
            </div>

        </div>
    </div>

@endsection
