@extends('omega::overt.install.layout')

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                Installation
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <h4>Site informations</h4>
                        <p>Basics settings for your website.</p>
                    </div>
                    <div class="col-md-8">
                        <dl class="dl-horizontal">
                            <dt>{{ __('Language') }}</dt>
                            <dd>{{ $lang }}</dd>
                            <dt>{{ __('Site title') }}</dt>
                            <dd>{{ $title }}</dd>
                            <dt>{{ __('Site slogan') }}</dt>
                            <dd>{{ $slogan }}</dd>
                        </dl>
                    </div>
                </div>
                <hr />

                <div class="row">
                    <div class="col-md-4">
                        <h4>Administrator</h4>
                        <p>Informations about the first user.</p>
                    </div>
                    <div class="col-md-8">
                        <dl class="dl-horizontal">
                            <dt>{{ __('E-mail') }}</dt>
                            <dd>{{ $email }}</dd>
                            <dt>{{ __('Username') }}</dt>
                            <dd>{{ $username }}</dd>
                            <dt>{{ __('Password') }}</dt>
                            <dd>{{ __('Hidden') }}</dd>
                        </dl>
                    </div>
                </div>

                <hr />

                {{ Form::open(['route' => 'omega.install.do', 'method' => 'POST', 'class' => 'form-horizontal main-form']) }}
                    <div class="d-flex justify-content-between">
                        <a class="btn btn-default" href="{{ route('omega.install.siteanduser') }}">{{ __('Back') }}</a>
                        {{ Form::submit(__('Install'), ['class' => 'btn btn-primary']) }}
                    </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
 @endsection