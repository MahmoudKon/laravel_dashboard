@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser("cities-index"))
        <a href="{{ routeHelper(getModel().'.cities.index', $id) }}" class="btn btn-outline-info dropdown-item">
            <i class="fa fa-list"></i> @lang('menu.cities')
        </a>
    @endif
@endsection
