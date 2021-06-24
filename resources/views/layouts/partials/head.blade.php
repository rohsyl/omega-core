<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="preload" as="font" href="{{ asset('/vendor/omega/webfonts/fa-solid-900.woff2') }}" type="font/woff2" crossorigin="anonymous">

    @preload
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

    <!-- Global js content -->
    <script src="/vendor/omega/js/app.js"></script>
    <!-- End of global js content-->

    <!-- Specific js content placeholder -->
    @routes()
    @stack('js')
    @livewireScripts()
    <!-- End of specific js content placeholder -->
</head>