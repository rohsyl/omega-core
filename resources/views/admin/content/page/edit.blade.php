@extends('omega::admin.layouts.admin')

@section('page-header')
    {{ __('Edit page') }}
    -
    {{ $page->title }}
@endsection

@section('left-small-card-content')
@endsection

@section('large-card-content')

    <livewire:omega_edit-page :page="$page" />

@endsection

