@extends('layouts.backend')

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}

        <div class="card-content collpase show">
            <div class="card-body">
                <div class="row">

                    @foreach ($data as $info)
                        @include('backend.simulate.list-commands')
                    @endforeach

                </div>
            </div>
        </div>
    </div>
@endsection
