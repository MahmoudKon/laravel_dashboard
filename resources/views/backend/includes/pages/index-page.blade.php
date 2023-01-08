@extends('layouts.backend')

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}


        <div class="card-content collpase show">
            <div id="search-form-body"></div>

            <div class="card-body" id="load-data"></div>
        </div>
    </div>
@endsection
