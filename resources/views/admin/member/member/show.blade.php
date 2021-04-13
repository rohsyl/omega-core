@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection


@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.members.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
    <a class="btn btn-outline-primary btn-sm" href="{{ route('omega.admin.member.members.edit', $member) }}"><i class="fas fa-edit"></i> {{ __('Edit member') }}</a>
    {{ Form::odelete(route('omega.admin.member.members.destroy', $member), ['class' => 'btn btn-outline-danger btn-sm', 'label' => __('Delete mbmer')]) }}
@endsection


@section('content')

    <div class="card">
        <div class="card-header">
            {{ ucfirst($member->username) }}
        </div>
        <div class="card-body">
            {{ Form::oattribute(__('Username'), $member->username) }}
            {{ Form::oattribute(__('E-Mail'), $member->email) }}
            {{ Form::oattribute(__('Member enabled '), $member->is_enabled ? __('Yes') : __('No')) }}
            {{ Form::oattribute(__('Validated at'), $member->validated_at) }}
        </div>
    </div>

@endsection
