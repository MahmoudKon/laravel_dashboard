@extends('layouts.backend')

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
    <script>
        $(function() {
            if ($(`li[data-route="{{ getRoutePrefex('.').getModel().'.create' }}"]`).length)
                $(`li[data-route="{{ getRoutePrefex('.').getModel().'.create' }}"]`).addClass('active').closest('.has-sub').addClass('active open');
            else
                $(`li[data-route="{{ getRoutePrefex('.').getModel().'.index' }}"]`).addClass('active').closest('.has-sub').addClass('active open');
        });
    </script>
@endsection
