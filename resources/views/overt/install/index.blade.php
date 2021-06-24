@extends('omega::overt.install.layout')


@section('content')
    <div class="container">
        {{ Form::open(['route' => 'omega.install.step1', 'method' => 'POST', 'class' => 'form-horizontal main-form']) }}
        <div class="card">
            <div class="card-header">
                {{ __('Installation') }}
            </div>
            <div class="card-body">

                <p>
                    {{ __('Welcome to the :omega installation. Click below to start the installation...', ['omega' => '<strong>Omega CMS</strong>']) }}
                </p>

                <p class="mB-0">
                    {{ __('Please select the language...') }}
                </p>

                <div class="form-group">
                    {{ Form::select('lang', [ 'en' => 'English', 'fr' => 'French', 'de' => 'German'], $lang, ['class' => 'form-control']) }}
                    @if ($errors->has('lang'))
                        <span class="text-danger" role="alert">
                    <strong>{{ $errors->first('lang') }}</strong>
                </span>
                    @endif
                </div>

                {{ Form::submit('Begin installation', ['class' => 'btn btn-primary btn-lg btn-block']) }}

            </div>
        </div>
        {{ Form::close() }}
    </div>

 @endsection