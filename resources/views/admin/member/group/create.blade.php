@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Member groups') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.member.groups.index') }}"><i class="fas fa-arrow-left"></i> {{ __('Back') }}</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.member.groups.store'), 'method' => 'post']) }}
    <x-oix-card title="{{ __('Group') }}" subtitle="{{ __('Create a new member group.') }}">

        {{ Form::otext('name', null, ['label' => __('Name'), 'autocomplete' => 'off']) }}

        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>
    {{ Form::close() }}
@endsection
