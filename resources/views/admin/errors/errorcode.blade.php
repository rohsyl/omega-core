@extends('omega::admin.default')

@section('content')

<div class="col-md-12">

    <h1><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>{{ $exception->getCode() }}</h1>

    <h2>{{ $exception->getMessage() }}</h2>

</div>