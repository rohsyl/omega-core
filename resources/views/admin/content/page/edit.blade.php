@extends('omega::admin.default')

@section('page-header')
    {{ __('Edit page') }}
    -
    {{ $page->title }}
@endsection

@section('content')

    <livewire:omega_edit-page :page="$page" />

@endsection

