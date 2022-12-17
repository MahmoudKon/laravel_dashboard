<!DOCTYPE html>
<html class="loading" lang="{{ App::getLocale() }}"
    data-textdirection="{{ LaravelLocalization::getCurrentLocaleDirection() }}"
    dir="{{ LaravelLocalization::getCurrentLocaleDirection() }}">

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
        <meta name="description"
            content="Modern admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities with bitcoin dashboard.">
        <meta name="keywords"
            content="admin template, modern admin template, dashboard template, flat admin template, responsive admin template, web app, crypto dashboard, bitcoin dashboard">
        <meta name="author" content="PIXINVENT">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page-title')</title>

        {{-- ************** START ICON ************** --}}
        <link rel="apple-touch-icon" href="{{ asset(setting('logo', '/')) }}">
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('logo', '/')) }}">
        {{-- ************** START ICON ************** --}}

        {{-- ************** START FONTS AWESOME ************** --}}
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('fonts/line-awesome/css/line-awesome.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/fontawesome-all.min.css') }}">
        {{-- ************** END FONTS AWESOME ************** --}}

        {{-- ************** START RTL , LTR CSS FILES ************** --}}
        @if (App::isLocale('ar'))
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/vendors.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/app.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/custom-rtl.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/core/menu/menu-types/vertical-menu.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/core/colors/palette-gradient.css') }}">
        @else
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/vendors.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/app.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/menu/menu-types/vertical-menu.css') }}">
            <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/colors/palette-gradient.css') }}">
        @endif
        {{-- ************** END RTL , LTR CSS FILES ************** --}}

        @yield('style')
        @stack('style')
    </head>

    <body class="vertical-layout vertical-menu 1-column @yield('body-class') menu-expanded blank-page blank-page" data-open="click" data-menu="vertical-menu" data-col="1-column"
            style="background-image: @yield('bg', 'none')">
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <section class="flexbox-container">
                        <div class="col-12 d-flex align-items-center justify-content-center">
                            <div class="box-shadow-2 p-0">
                                {{-- START CONTENT SECTION --}}
                                @yield('content')
                                {{-- END CONTENT SECTION --}}
                            </div>
                        </div>
                    </section>
                    <x-announcement />
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{{ assetHelper('vendors/js/vendors.min.js') }}"></script>
        <script type="text/javascript" src="{{ assetHelper('vendors/js/coming-soon/jquery.countdown.min.js') }}"></script>
        <script type="text/javascript" src="{{ assetHelper('js/core/app-menu.js') }}"></script>
        <script type="text/javascript" src="{{ assetHelper('js/core/app.js') }}"></script>

        @yield('script')
        @stack('script')
    </body>

</html>
