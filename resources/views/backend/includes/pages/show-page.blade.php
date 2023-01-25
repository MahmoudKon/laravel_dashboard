@extends('layouts.backend')

@section('content')
<div class="card">
    {{-- START INCLUDE TABLE HEADER --}}
    @include('backend.includes.cards.table-header', ['title' => trans('title.show-row-details', ['model' => trans('menu.'.getModel(true))])])
    {{-- START INCLUDE TABLE HEADER --}}

    <div class="card-content collpase show">
        <div class="card-body">
            @include('backend.'.getModel(view:true).'.show')
        </div>
    </div>
</div>
@endsection

@section('script')
    <script>
        $(function() {
            $(`li[data-route="{{ getRoutePrefex('.').getModel().'.index' }}"]`).addClass('active').closest('.has-sub').addClass('active open');
        });
    </script>
@endsection
