@extends('layouts.backend')

@section('content')
    @php $check_permission = canUser(getModel()."-create"); @endphp
    <div class="content-detached {{ $check_permission ? "content-right" : "" }}">
        <div class="content-body">
            <div class="card">
                {{-- START INCLUDE TABLE HEADER --}}
                @include('backend.includes.cards.table-header')
                {{-- START INCLUDE TABLE HEADER --}}

                <div class="card-content collpase show">

                    <div id="search-form-body"></div>

                    <div class="card-body" id="load-data"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- START INCLUDE SIDEBARE --}}
    @if ($check_permission)
        @include('backend.includes.cards.sidebare')
    @endif
    {{-- END INCLUDE SIDEBARE --}}
@endsection
