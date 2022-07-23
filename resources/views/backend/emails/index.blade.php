@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('css/pages/email-application.css') }}">
@endsection


@section('content')
    @include('backend.emails.includes.sidebar')

    <div class="content-right">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="card email-app-details d-none d-lg-block">
                    <div class="card-content" id="preview-email-body"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ assetHelper('js/scripts/pages/email-application.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/email-app.js') }}"></script>
@endsection
