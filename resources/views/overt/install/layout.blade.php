<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Omega') }}</title>

    <!-- Styles -->
    <link href="/vendor/omega/css/app.css" rel="stylesheet">
{{-- <link href="{{ mix('/css/rtl.css') }}" rel="stylesheet"> --}}

<!-- Global css content -->

    <!-- End of global css content-->

    <!-- Specific css content placeholder -->
@stack('css')
<!-- End of specific css content placeholder -->
</head>

<body class="app">

@include('omega::admin.partials.spinner')

<div>
    <!-- #Left Sidebar ==================== -->

<!-- #Main ============================ -->
    <div class="">
        <!-- ### $Topbar ### -->
        <div class="bgc-white p-15 bdB fixed-top">
            <div class="font-weight-bold">
                {{__('Omega CMS')}}
            </div>
        </div>




        <!-- ### $App Screen Content ### -->
        <main class='main-content bgc-grey-100'>
            <div id='mainContent'>
                <div class="container-fluid">

                    <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>

                    @yield('content')

                </div>
            </div>
        </main>

        <!-- ### $App Screen Footer ### -->
        <footer class="bdT ta-r p-30 lh-0 fsz-sm c-grey-600">
            <span>© {{ date('Y') }} | Made with <i class="fa fa-heart c-pink-800"></i> by <a href="https://github.com/rohsyl">rohsyl</a></span>
        </footer>
    </div>
</div>

<script src="/vendor/omega/js/app.js"></script>

<!-- Global js content -->

<!-- End of global js content-->

<!-- Specific js content placeholder -->
@stack('js')
<!-- End of specific js content placeholder -->

</body>

</html>