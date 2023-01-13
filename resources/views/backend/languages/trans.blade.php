@extends('layouts.backend')

@section('content')
    <div class="card">
        <div class="card-header bg-primary">
            <h3 class="card-title white"> Trans </h3>
        </div>

        <div class="card-body">
            @csrf

            <div class="row">
                @include('backend.languages.includes.list-trans', ['key' => $trans])
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function() {
            $(`li[data-route="{{ ROUTE_PREFIX.getModel().'.index' }}"]`).addClass('active').closest('.has-sub').addClass('active open');
        });
    </script>
@endsection
