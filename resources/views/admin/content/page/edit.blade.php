@extends('omega::admin.default')

@section('page-header')
    {{ __('Pages') }}
@endsection

@section('actions')
@endsection

@section('content')

    {{ Form::oback() }}

    <div class="card">
        <div class="card-header">
            {{ $page->title  }}
        </div>
        <div class="card-body">

            <livewire:omega_edit-page />
        </div>
    </div>


@endsection

