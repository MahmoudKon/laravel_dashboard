@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/toggle/switchery.min.css') }}">
@endsection

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}

        <div id="search-form-body"></div>

        <div class="card-content collpase show">
            <div class="card-body" id="load-data"></div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/tables/datatable/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('customs/js/search.js') }}"></script>
@endsection
