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
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    @include('layouts.manager.subheader')
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

    <script>
        $(document).ready(function (){
            //get location
            @if(Auth::user())
            var latitude,longitude;
            navigator.geolocation.getCurrentPosition(function (position) {
                $.ajax({
                    url: "{{ route('api-log-location') }}",
                    type: 'PUT',
                    data: {
                        x: position.coords.latitude,
                        y: position.coords.longitude,
                    }
                })
            })
            @endif

            @if(Auth::user()->role === GUIDE)
            $.ajax({
                url: '{{route('api-new-invoice')}}',
                type: 'get',
                success: function (res) {
                    let notification = res.data.map(function (val,index){
                        let date = new Date(val.created_at);
                        return `<div class="p-2">
                        <strong class="d-block">
                            <a href="/manager/invoices/${val.sku}">${val.invoice_detail.name}</a>
                        </strong>
                        <small>${val.sku}</small></br>
                        <span>** ${date.toLocaleTimeString()} - ${date.toLocaleDateString("vi")} **</span>
                    </div><hr>`;
                    })
                    $(`.total-notification`).text(res.data.length)
                    $(`.notification`).append(notification)
                },
                error: function (error) {
                    console.log(error)
                }
            })
            @else
            $.ajax({
                url: '{{route('api-new-tour')}}',
                type: 'get',
                success: function (res) {
                    let notification = res.data.map(function (val,index){
                        let date = new Date(val.created_at);
                        return `<div class="p-2">
                        <strong class="d-block">
                            <a href="/tours/show/${val.slug}" target="_blank">${val.name}</a>
                        </strong>
                        <small>${val.guide.first_name} ${val.guide.last_name}</small></br>
                        <span>** ${date.toLocaleTimeString()} - ${date.toLocaleDateString("vi")} **</span>
                    </div><hr>`;
                    })
                    $(`.total-notification`).text(res.data.length)
                    $(`.notification`).append(notification)
                },
                error: function (error) {
                    console.log(error)
                }
            })
            @endif
        })

        $(`select[name='type']`).change(function () {
            let value = $(this).val();
            let data = {};
            switch (value) {
                case "days": data = {title: 'Nhắc nhở',message:'Hãy nhập chính xác ngày - tháng - năm ! '}
                break;
                case "months": data = {title: 'Nhắc nhở',message:'Hãy nhập chính xác tháng - năm ! '}
                break;
                case "years": data = {title: 'Nhắc nhở',message:'Hãy nhập chính xác năm ! '}
                break;
            }
            $.notify(data,{
                allow_dismiss: false,
                newest_on_top: true,
                mouse_over:  false,
                showProgressbar:  false,
                spacing: 10,
                timer: 500,
                delay: 200,
            })
        })
        showNotify = (res, error = false) => {
            $.notify({
                title: !error ? (res.data.title || '') : 'Error',
                message: !error ? res.data.message : 'Có lỗi xảy ra'
            }, {
                type: !error ? (res.status === 200 ? 'success' : 'danger') : 'danger',
                allow_dismiss: false,
                newest_on_top: true,
                mouse_over:  false,
                showProgressbar:  false,
                spacing: 10,
                timer: 2000,
                placement: {
                    from: 'top',
                    align: 'right'
                },
                offset: {
                    x: 30,
                    y: 30
                },
                delay: 1000,
                z_index: 10000,
                animate: {
                    enter: 'animate__animated animate__bounceIn',
                    exit: 'animate__animated animate__bounceOut'
                }
            });
        }
    </script>
    <!-- Extra js -->
    @yield('extra-js')

    @yield('lasted-js')
</body>
</html>
