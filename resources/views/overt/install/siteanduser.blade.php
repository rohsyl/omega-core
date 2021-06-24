@extends('omega::overt.install.layout')


@section('content')
    <div class="container">

        {{ Form::open(['route' => 'omega.install.step2', 'method' => 'POST', 'class' => 'form-horizontal main-form']) }}
        <div class="card">
            <div class="card-header">
                {{ __('Installation') }}
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-md-4">
                        <h4>{{ __('Site informations') }}</h4>
                        <p>{{ __('Please fill out the name and the slogan of your website.') }}</p>
                    </div>
                    <div class="col-md-8">
                        <div class="form-group">
                            {{ Form::label('title', __('Site title'), ['class' => 'control-label']) }}
                            {{ Form::text('title', $title, ['class' => 'form-control']) }}
                            @if ($errors->has('title'))
                                <span class="text-danger" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('slogan', __('Site slogan'), ['class' => 'control-label']) }}
                            {{ Form::text('slogan', $slogan, ['class' => 'form-control']) }}
                            @if ($errors->has('slogan'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('slogan') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-md-4">
                        <h4>{{ __('Administrator') }}</h4>
                        <p>{{ __('Create a new user') }}</p>
                    </div>
                    <div class="col-md-8">

                        <div class="form-group">
                            {{ Form::label('email', __('E-mail :'), ['class' => 'control-label']) }}
                            {{ Form::email('email', $email, ['class' => 'form-control']) }}
                            @if ($errors->has('email'))
                                <span class="text-danger" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::label('password', __('Password :'), ['class' => 'control-label']) }}
                            {{ Form::password('password', ['class' => 'form-control']) }}
                            @if ($errors->has('password'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            {{ Form::password('password2', ['class' => 'form-control']) }}
                            @if ($errors->has('password2'))
                                <span class="text-danger" role="alert">
                                    <strong>{{ $errors->first('password2') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>


                <hr />
                <div class="d-flex justify-content-between">
                    <a href="{{ route('omega.install.index') }}" class="btn btn-light">{{ __('Back') }}</a>
                    {{ Form::submit(__('Next'), ['class' => 'btn btn-primary']) }}
                </div>

            </div>
        </div>
        {{ Form::close() }}
    </div>
 @endsection