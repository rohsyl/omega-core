@extends('omega::admin.default')
@section('page-header')
    @yield('page-header')
@endsection
@section('content')
    <div class="row">
        @hasSection('large-card-content')
            <div class="col-12 col-lg-8 order-5 order-lg-0">
                <div class="card text-center">
                    <div class="card-body text-left">
                        @hasSection('large-card-title')
                            <h5>@yield('large-card-title')</h5>
                            <hr class="w-25 ml-0">
                        @endif
                        @yield('large-card-content')
                    </div>
                </div>
            </div>
        @endif
        <div class="col order-0 order-lg-1">
            <div class="row">
                @hasSection('left-small-card-content')
                    <div class="col-6 col-lg-12">
                        <div class="card text-center">
                            <div class="card-body text-left">
                                @hasSection('left-small-card-title')
                                    @yield('left-small-card-title')
                                    <hr class="w-25 ml-0">
                                @endif
                                @yield('left-small-card-content')
                            </div>
                        </div>
                    </div>
                @endif
                @hasSection('right-small-card-content')
                    <div class="col-6 col-lg-12">
                        <div class="card text-center">
                            <div class="card-body text-left">
                                @hasSection('left-small-card-title')
                                    @yield('right-small-card-title')
                                    <hr class="w-25 ml-0">
                                @endif
                                @yield('right-small-card-content')
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

@endsection
