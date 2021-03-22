<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/vendor/omega/css/app.css" rel="stylesheet">
    <!--<link href="{{ asset('vendor/omega/css/app.css') }}" rel="stylesheet">-->
    {{-- <link href="{{ mix('/css/rtl.css') }}" rel="stylesheet"> --}}
    
    <!-- Global css content -->

    <!-- End of global css content-->

    <!-- Specific css content placeholder -->
    @stack('css')
    @livewireStyles()
    <!-- End of specific css content placeholder -->

    <script src="/vendor/omega/js/app.js"></script>

    <!-- Global js content -->

    <!-- End of global js content-->

    <!-- Specific js content placeholder -->
    @stack('js')
    @livewireScripts()
    <!-- End of specific js content placeholder -->
</head>