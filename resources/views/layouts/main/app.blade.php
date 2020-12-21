<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description"
          content="Citytours - Premium site template for city tours agencies, transfers and tickets.">
    <meta name="author" content="Team FPoly">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @hasSection('title')
        <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif

    <!-- Favicons-->
    <link rel="shortcut icon" href="{{ asset('Libraries/Main/img/favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon"
          href="{{ asset('Libraries/Main/img/apple-touch-icon-57x57-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72"
          href="{{ asset('Libraries/Main/img/apple-touch-icon-72x72-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114"
          href="{{ asset('Libraries/Main/img/apple-touch-icon-114x114-precomposed.png') }}">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144"
          href="{{ asset('Libraries/Main/img/apple-touch-icon-144x144-precomposed.png') }}">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Mitr:wght@400&display=swap" rel="stylesheet">

    <!-- COMMON CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="{{ asset('Libraries/Main/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('Libraries/Main/css/vendors.css') }}" rel="stylesheet">

    <!-- CUSTOM CSS -->
    <link href="{{ asset('Libraries/Main/css/custom.css') }}" rel="stylesheet">

    <!-- Extra Css -->
    @yield('extra-css')

</head>
<body>
    <!-- Load Facebook SDK for JavaScript -->
    <div id="fb-root"></div>
    <script>
        window.fbAsyncInit = function() {
            FB.init({
                xfbml            : true,
                version          : 'v9.0'
            });
        };

        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Your Chat Plugin code -->
    <div class="fb-customerchat"
         attribution=setup_tool
         page_id="100149461997048"
         theme_color="#fa3c4c"
         logged_in_greeting="Xin chào. Bạn cần trợ giúp?"
         logged_out_greeting="Xin chào. Bạn cần trợ giúp?">
    </div>
    <div id="app">

        @include('layouts.main.preload')
        <!-- End Preload -->

        <div class="layer"></div>
        <!-- Mobile menu overlay mask -->

        <!-- Header -->
        @include('layouts.main.header')
        <!-- End Header -->

        @yield('content')
        <!-- End main -->

        @include('layouts.main.footer')
        <!-- End footer -->

        @include('layouts.main.totop')
        <!-- Back to top button -->

            <!-- Search Menu -->
        @include('layouts.main.search')
        <!-- End Search Menu -->

            <!-- Sign In Popup -->
        @include('layouts.main.login')
        <!-- /Sign In Popup -->
    </div>

    <!-- Common scripts -->
    <script>var BASE_URL = "{{ env('APP_URL') }}"</script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('Libraries/Main/js/common_scripts_min.js') }}"></script>
    <script src="{{ asset('Libraries/Main/js/functions.js') }}"></script>

    <script src="{{ asset('Libraries/Main/js/jquery.selectbox-0.2.js') }}"></script>
    <script>
        // ----------------------- SELECTBOX --------------------------- //
        // change style for select box
        $(".selectbox").selectbox();
    </script>

    <!-- Extra js -->
    @yield('extra-js')

    @if(session(TOASTR))
        <script>
            Toastr.show({!! session(TOASTR) !!})
        </script>
    @endif
</body>
</html>
