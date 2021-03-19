@extends('omega::admin.default')

@section('page-header')
    {{ __('Plugins') }}
@endsection


@section('content')

    <div class="card">
        <div class="card-body p-0">
            <table class="table">

            </table>
            @dump($plugins)
        </div>
    </div>


@endsection

