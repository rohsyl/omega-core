@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Menus') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.appearance.menus.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
@endsection

@section('content')

    {{ Form::open(['url' => route('omega.admin.appearance.menus.store'), 'method' => 'post']) }}
    <x-oix-card title="Menu" subtitle="Create a new menu.">
        {{ Form::otext('name', null, ['label' => __('Title')]) }}
        {{ Form::otextarea('description', null, ['label' => __('Description')]) }}

        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>
    {{ Form::close() }}

@endsection

