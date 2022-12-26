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
    <title>@lang('menu.dashboard') {{ getModel() == 'dashboard' ? '' : ' | ' . trans('menu.'.getModel()) }}</title>

    {{-- ************** START ICON ************** --}}
    <link rel="apple-touch-icon" href="{{ asset(setting('logo', '/')) }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset(setting('logo', '/')) }}">
    {{-- ************** START ICON ************** --}}

    {{-- ************** START FONTS AWESOME ************** --}}
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('fonts/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/fontawesome-all.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/toggle/bootstrap-switch.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/toggle/switchery.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/plugins/forms/switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/colors/palette-switch.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/plugins/loaders/loaders.min.css') }}">
    {{-- ************** END FONTS AWESOME ************** --}}

    {{-- ************** START RTL , LTR CSS FILES ************** --}}
    @if (App::isLocale('ar'))
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/custom-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css-rtl/core/colors/palette-loader.css') }}">
    @else
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/menu/menu-types/vertical-menu.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/core/colors/palette-loader.css') }}">

    {{ config()->set('sweetalert.toast_position', 'top-end') }}
    @endif
    {{-- ************** END RTL , LTR CSS FILES ************** --}}

    {{-- ************** START MODERN CSS ************** --}}
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
    {{-- ************** END MODERN CSS ************** --}}

    {{-- ************** START DATATABLES ************** --}}
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/plugins/animate/animate.css') }}">
    {{-- ************** START DATATABLES ************** --}}

    {{-- ************** START CUSTOM CSS ************** --}}
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/loading.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/preview-file.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/email.css') }}">
    {{-- ************** END CUSTOM CSS ************** --}}

    @if (App::isLocale('ar'))
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('customs/css/style_ar.css') }}">
    @endif

    @yield('style')
    @stack('style')
</head>

{{-- <body class="vertical-layout vertical-menu content-detached-left-sidebar menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-col="content-detached-left-sidebar"> --}}
<body id="loader-progress" class="vertical-layout vertical-menu content-left-sidebar email-application fixed-navbar menu-expanded pace-done" data-open="click" data-menu="vertical-menu" data-col="content-left-sidebar">

    {{-- <div id="body-loading"> <span> ... Loading ...</span> </div> --}}

    {{-- <div id="page-loading-animation">
        <div>G</div>
        <div>N</div>
        <div>I</div>
        <div>D</div>
        <div>A</div>
        <div>O</div>
        <div>L</div>
    </div> --}}

    <div id="page-loading-animation">
        <span></span>
        <span></span>
        <span></span>
    </div>



