@extends('omega::admin.layouts.default')

@section('page-header')
    {{ __('Members') }}
@endsection

@section('actions')
@endsection

@section('content')

    @include('omega::admin.member.sub._menu', ['active' => 'members'])

    <div class="card">
        <div class="card-body">

        </div>
    </div>
@endsection
