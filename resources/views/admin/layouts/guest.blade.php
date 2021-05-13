<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('omega::layouts.partials.head')

<body class="app">

    @include('omega::admin.partials.spinner')


    @yield('content')


    <!-- Global js content -->

    <!-- End of global js content-->

    <!-- Specific js content placeholder -->
    @stack('js')
    <!-- End of specific js content placeholder -->

</body>

</html>