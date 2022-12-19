<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
    <meta name="keywords" content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
    <meta name="author" content="PIXINVENT">
    <title>@yield('page_title')</title>
    <link rel="apple-touch-icon" href="{{ asset(setting('logo', '/')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('logo', '/')) }}">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/fontawesome-all.min.css') }}">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/icheck/custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/colors/palette-tooltip.css') }}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/app.css') }}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/pages/login-register.css') }}">
    <!-- END Page Level CSS-->

    {{-- ************** START CUSTOM CSS ************** --}}
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/loading.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/preview-file.css') }}">
    {{-- ************** END CUSTOM CSS ************** --}}
</head>
<body class="vertical-layout blank-page">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section class="flexbox-container">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="col-md-6 col-10 box-shadow-2 p-0">
                            <div class="card border-grey border-lighten-3 m-0">
                                <div class="card-header border-0 pb-0">
                                    <div class="card-title text-center">
                                        <div class="pb-1">
                                            @auth
                                            <img alt="{{ auth()->user()->name }}" src="{{ auth()->user()->image }}" class="rounded-circle img-fluid center-block" style="width: 100px; height: 100px;">
                                            <h5 class="card-title mt-1">{{ auth()->user()->name }}</h5>
                                            @else
                                            <img alt="@lang('menu.logo')" src="{{ asset(setting('logo', 'samples/logo/ivas.png')) }}" style="max-width: 100px;">
                                            @endauth
                                        </div>
                                    </div>
                                    <h6 class="card-subtitle line-on-side text-muted text-center font-medium-2 p-0">
                                        <span>@yield('title')</span>
                                    </h6>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        @include('layouts.includes.backend.alerts')
                                        @yield('content')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <!-- BEGIN VENDOR JS-->
    <script type="text/javascript" src="{{ assetHelper('vendors/js/vendors.min.js') }}"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/icheck/icheck.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/validation/jqBootstrapValidation.js') }}"></script>
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script type="text/javascript" src="{{ assetHelper('js/core/app-menu.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/core/app.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/fontawesome-all.min.js') }}"></script>
    <!-- END MODERN JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/form-login-register.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/tooltip/tooltip.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/show-password.js') }}"></script>
    <!-- END PAGE LEVEL JS-->

    <script>
        $(function() {
            $('form').submit(function (e) { $(this).closest('.card').addClass('load'); });
        });
    </script>

    @yield('script')
</body>
</html>
