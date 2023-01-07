@extends('layouts.backend')

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
