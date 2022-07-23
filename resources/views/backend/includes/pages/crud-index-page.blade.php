@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/tables/datatable/datatables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/tables/extensions/buttons.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/toggle/switchery.min.css') }}">
@endsection

@section('content')
    @php $check_permission = canUser(getModel()."-create"); @endphp
    <div class="content-detached {{ $check_permission ? "content-right" : "" }}">
        <div class="content-body">
            <div class="card">
                {{-- START INCLUDE TABLE HEADER --}}
                @include('backend.includes.cards.table-header')
                {{-- START INCLUDE TABLE HEADER --}}

                <div class="card-content collpase show">
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

@push('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/tables/datatable/datatables.min.js') }}"></script>
@endpush
