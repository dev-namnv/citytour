<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') | Manager - {{ env('APP_NAME') }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif

    <!-- App css -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Favicons -->
    <link rel="icon" type="image/x-icon" href="{{ asset('libraries/manager/assets/img/favicon.ico') }}"/>
    <link href="{{ asset('libraries/manager/assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('libraries/manager/assets/js/loader.js') }}"></script>

    <!-- Google web fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('libraries/manager/assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />

    {{--<!-- Google map api -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK2YgbtxirmtB2cSjonFB_9r5iHz7_1IQ&libraries=places" />--}}

    <!-- Extra css -->
    @yield('extra-css')

</head>
<body>
    @include('layouts.manager.loadscreen')

    @include('layouts.manager.header')

    @include('layouts.manager.subheader')

    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        @include('layouts.manager.sidebar')

        <div class="main-content" id="content">

            @yield('content')

            @include('layouts.manager.footer')

        </div>
    </div>

    <script>var BASE_URL = "{{ env('APP_URL') }}";</script>
    <!-- Admin js -->
    <script src="{{ asset('js/admin.js') }}"></script>

    <!-- Google map api -->
{{--    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBK2YgbtxirmtB2cSjonFB_9r5iHz7_1IQ&libraries=places" />--}}

    <!-- Common js -->
    <script src="{{ asset('libraries/manager/assets/js/app.js') }}"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{ asset('libraries/manager/assets/js/custom.js') }}"></script>

    <!-- Extra js -->
    @yield('extra-js')

    @if(session(TOASTR))
        <script>
            Toastr.show({!! session(TOASTR) !!})
        </script>
    @endif
</body>
</html>
