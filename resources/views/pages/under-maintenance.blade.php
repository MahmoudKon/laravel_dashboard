@extends('layouts.flat-page')

@section('page-title', 'Under Maintenance')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/pages/under-maintenance.css') }}">
@endsection

@section('content')
    <div class="card-body">
        <span class="card-title text-center">
            <img src="{{ asset( setting('logo', 'images/logo/logo-dark-lg.png') ) }}"
                class="img-fluid mx-auto d-block pt-2" width="250" alt="logo">
        </span>
    </div>
    <div class="card-body text-center">
        <h3>@lang('title.this page is under maintenance')</h3>
        <p>@lang("title.we're sorry for the inconvenience")
            <br> @lang('title.please check back later')
        </p>
        <div class="mt-2"><i class="la la-cog spinner font-large-2"></i></div>
    </div>
@endsection
