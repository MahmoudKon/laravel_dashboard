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

    {{-- ************** START APP STYLES ************** --}}
    @vite(['resources/css/app.css'])
    {{-- ************** END APP STYLES ************** --}}

    {{-- ************** START RTL , LTR CSS FILES ************** --}}
    @if (App::isLocale('ar'))
        @vite(['resources/css/app-rtl.css'])
    @else
        @vite(['resources/css/app-ltr.css'])
        {{ config()->set('sweetalert.toast_position', 'top-end') }}
    @endif
    {{-- ************** END RTL , LTR CSS FILES ************** --}}

    {{-- ************** START CUSTOM STYLES ************** --}}
    @vite(['resources/css/custom.css'])
    {{-- ************** END CUSTOM STYLES ************** --}}

    @yield('style')
    @stack('style')
</head>

<body id="loader-progress" class="vertical-layout vertical-menu content-left-sidebar email-application fixed-navbar menu-expanded pace-done" data-open="click" data-menu="vertical-menu" data-col="content-left-sidebar">

    <div id="page-loading-animation">
        <span></span>
        <span></span>
        <span></span>
    </div>



