<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @hasSection('title')
        <title>@yield('title') | {{ env('APP_NAME') }}</title>
    @else
        <title>{{ env('APP_NAME') }}</title>
    @endif

    <link rel="icon" type="image/x-icon" href="{{ asset('libraries/manager/assets/img/favicon.ico') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('libraries/manager/assets/css/plugins.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('libraries/manager/assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css"/>
    <!-- END GLOBAL MANDATORY STYLES -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/manager/assets/css/forms/theme-checkbox-radio.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libraries/manager/assets/css/forms/switches.css') }}">

    <style>
        input.is-invalid{
            border-bottom: 1px solid #e3342f !important;
        }
        input.is-valid{
            border-bottom: 1px solid #38c172 !important;
        }
    </style>
</head>
<body class="form">


<div class="form-container">
    <div class="form-form">
        <div class="form-form-wrap">
            <div class="form-container">
                @yield('content')
            </div>
        </div>
    </div>
    <div class="form-image">
        <div class="l-image">
        </div>
    </div>
</div>

<script>var BASE_URL = "{{ env('APP_URL') }}"</script>
<script src="{{ asset('js/admin.js') }}"></script>
<script src="{{ asset('libraries/manager/assets/js/authentication/form-1.js') }}"></script>

@if(session(TOASTR))
    <script>
        Toastr.show({!! session(TOASTR) !!})
    </script>
@endif
</body>
</html>
