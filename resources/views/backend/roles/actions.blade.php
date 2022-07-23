@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser(getModel()."-show"))
        <a href="{{ routeHelper(getModel().'.show', $id) }}" class="btn btn-outline-info dropdown-item">
            <i class="ft-eye"></i> @lang('buttons.cover')
        </a>
    @endif
@endsection
