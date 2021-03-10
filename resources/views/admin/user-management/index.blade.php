@extends('omega::admin.layouts.admin')
@section('page-header')
    Users & Groups Management
@endsection


@section('large-card-content')
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
@endsection

@section('left-small-card-title')
    <h5>{{ __('Add') }}</h5>
@endsection
@section('left-small-card-content')
    <div class="row">
    <div class="col">
        <a class="btn btn-outline-primary col" href="{{ route('omega.admin.users.create') }}">{{ __('Add user') }}</a>
    </div>
    <div class="col">
        <a class="btn btn-outline-primary col" href="{{ route('omega.admin.groups.create') }}">{{ __('Add groups') }}</a>
    </div>
</div>
@endsection

@section('right-small-card-title')
@endsection

@section('right-small-card-content')
@endsection
