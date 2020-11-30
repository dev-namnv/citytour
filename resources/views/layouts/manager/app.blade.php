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

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->

    <!--begin::Global Theme Styles(used by all pages)-->
    <link href="{{ asset('Libraries/Manager/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('Libraries/Manager/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('Libraries/Manager/css/style.bundle.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Global Theme Styles-->

    <!--begin::Layout Themes(used by all pages)-->
    <link href="{{ asset('Libraries/Manager/css/themes/layout/header/base/light.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('Libraries/Manager/css/themes/layout/header/menu/light.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('Libraries/Manager/css/themes/layout/brand/light.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('Libraries/Manager/css/themes/layout/aside/light.css') }}" rel="stylesheet" type="text/css"/>
    <!--end::Layout Themes-->

    <link rel="shortcut icon" href="{{ asset('Libraries/Manager/media/logos/favicon.ico') }}"/>

    <!-- Extra css -->
    @yield('extra-css')

</head>
<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
    @include('layouts.manager.header_mobile')

    <div class="d-flex flex-column flex-root">
        <div class="d-flex flex-row flex-column-fluid page">
            @include('layouts.manager.aside')

            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                @include('layouts.manager.header')
                    <div class="d-flex flex-column-fluid">
                        @yield('content')
                    </div>
                </div>

                @include('layouts.manager.footer')
            </div>
        </div>
    </div>

    @include('layouts.manager.quick_user')

    @include('layouts.manager.scrolltop')

    @include('layouts.manager.quick_panel')

    <script>var BASE_URL = "{{ env('APP_URL') }}";</script>

    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };</script>

    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('Libraries/Manager/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('Libraries/Manager/js/scripts.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->

    <script src="{{ asset('Libraries/Manager/js/pages/widgets.js') }}"></script>

    <!-- Extra js -->
    @yield('extra-js')

    @yield('lasted-js')
</body>
</html>
