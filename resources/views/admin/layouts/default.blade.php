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
                            <div>
                                <h4 class="c-grey-900 mT-10 mB-10">@yield('page-header')</h4>
                            </div>
                            <div>
                                @yield('actions')
                            </div>
                        </div>


                        @include('omega::admin.partials.messages')



                        @yield('content')

                    </div>
                </div>
            </main>

            <!-- ### $App Screen Footer ### -->
            <footer class="bdT ta-c p-30 lh-0 fsz-sm c-grey-600">
                <span>Copyright © {{ date('Y') }}</span>
            </footer>
        </div>
    </div>

    @livewire('livewire-ui-modal2')
    <script>
        Alpine.start()
    </script>
</body>

</html>