@extends('layouts.backend')

@section('content')
    <div class="card">
        {{-- START INCLUDE TABLE HEADER --}}
        @include('backend.includes.cards.table-header')
        {{-- START INCLUDE TABLE HEADER --}}

        <div class="card-content collpase show">
            <div class="card-body">
                @include('backend.commands.output')

                <div class="row">
                    @foreach($commands as $command)
                        @include('backend.commands.command', ['command' => $command])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
