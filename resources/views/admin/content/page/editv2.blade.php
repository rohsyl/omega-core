<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link href="{{ asset('vendor/omega/css/grapes.css?1') }}" rel="stylesheet">

        @routes()
    </head>
    <body>

        <div class="editor-container">
            <div class="panel__top">
                <div class="panel__devices"></div>
                <div class="panel__basic-actions"></div>
                <div class="panel__switcher"></div>
            </div>
            <div class="editor-row">
                <div class="editor-canvas">
                    <div id="gjs">
                        <div>Yo</div>
                    </div>
                </div>
                <div class="panel__right">
                    <div class="layers-container"></div>
                    <div class="styles-container"></div>
                    <div class="traits-container"></div>
                    <div class="blocks-container"></div>
                </div>
            </div>
        </div>


        <script src="{{ asset('vendor/omega/js/grapes.js') }}"></script>


    </body>
</html>