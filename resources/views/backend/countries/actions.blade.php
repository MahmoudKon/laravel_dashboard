@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser("operators-create"))
        <a href="{{ routeHelper('countries.operators.index', $id) }}" class="btn btn-outline-info dropdown-item">
            <i class="ft-plus"></i> @lang('buttons.create-operator')
        </a>
    @endif
@endsection
