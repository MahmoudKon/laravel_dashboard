@extends('layouts.backend')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/toggle/switchery.min.css') }}">
@endsection

@section('back')
    @include('backend.includes.cards.form-header')
@endsection

@section('content')
<div class="content-body">
    <div class="card">
        @if (isset($row))
        @include('backend.includes.forms.form-update')
        @else
        @include('backend.includes.forms.form-create')
        @endif
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/extended/maxlength/bootstrap-maxlength.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/select/form-select2.js') }}"></script>
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/input-groups.js') }}"></script>
    <script>
        $(function() {
            if ($(`li[data-route="{{ ROUTE_PREFIX.getModel().'.create' }}"]`).length)
                $(`li[data-route="{{ ROUTE_PREFIX.getModel().'.create' }}"]`).addClass('active').closest('.has-sub').addClass('active open');
            else
                $(`li[data-route="{{ ROUTE_PREFIX.getModel().'.index' }}"]`).addClass('active').closest('.has-sub').addClass('active open');
        });
    </script>
@endsection
