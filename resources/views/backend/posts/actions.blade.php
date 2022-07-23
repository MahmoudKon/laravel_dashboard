@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    <a href="{{ routeHelper(getModel().'.short.url', $id) }}" class="btn btn-outline-info dropdown-item show-modal-form">
        <i class="fa fa-link"></i> @lang('buttons.short-link')
    </a>
@endsection
