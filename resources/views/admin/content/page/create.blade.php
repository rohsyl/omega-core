@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Pages') }}
@endsection

@section('actions')
    <a class="btn btn-outline-secondary btn-sm" href="{{ route('omega.admin.content.pages.index') }}"><i class="fas fa-arrow-left"></i> Back</a>
@endsection

@section('content')


    {{ Form::open(['url' => route('omega.admin.content.pages.store'), 'method' => 'post']) }}

    <x-oix-card title="Page" subtitle="Create a new page.">

        {{ Form::otext('title', null, ['label' => __('Title')]) }}

        {{ Form::oback() }}
        {{ Form::osubmit() }}
    </x-oix-card>

    {{ Form::close() }}

@endsection

