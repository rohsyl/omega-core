<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

@include('omega::layouts.partials.head')

<body class="app">

    <div>
        <!-- #Left Sidebar ==================== -->
        @include('omega::admin.partials.sidebar')

        <!-- #Main ============================ -->
        <div class="page-container">
            <!-- ### $Topbar ### -->
            @include('omega::admin.partials.topbar')

            <!-- ### $App Screen Content ### -->
            <main class='main-content bgc-grey-100'>
                <div id='mainContent'>
                    <div class="container-fluid">

                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="c-grey-900 mT-10 mB-30">@yield('page-header')</h4>
                            @yield('actions')
                        </div>


                        @include('omega::admin.partials.messages')
                        @yield('content')

                    </div>
                </div>
            </main>

            <!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © {{ date('Y') }} Designed by
                    <a href="https://colorlib.com" target='_blank' title="Colorlib">Colorlib</a>. All rights
                    reserved.</span>
            </footer>
        </div>
    </div>


</body>

</html>