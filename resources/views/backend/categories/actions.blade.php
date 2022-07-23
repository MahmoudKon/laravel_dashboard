@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser(getModel()."-create"))
        <a href="{{ routeHelper('categories.subs.create', $id) }}" class="btn btn-outline-info dropdown-item show-modal-form">
            <i class="ft-plus"></i> @lang('buttons.create-sub-category')
        </a>
    @endif
@endsection
