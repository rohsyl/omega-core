@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Groups') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.users.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.groups.edit', $group) }}"><i class="fas fa-edit"></i> {{ __('Edit group') }}</a>
    {{ Form::odelete(route('omega.admin.groups.destroy', $group), ['class' => 'btn btn-outline-danger btn-sm', 'label' => __('Delete group')]) }}
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            {{ $group->name }}
        </div>
        <div class="card-body">
            {{ Form::oattribute(__('Name'), $group->name) }}
            {{ Form::oattribute(__('Description'), $group->description) }}
            {{ Form::oattribute(__('Group enabled '), $group->is_enabled ? __('Yes') : __('No')) }}
        </div>
    </div>
@endsection