@extends('backend.includes.buttons.table-buttons')

@section('table-buttons')
    @if (canUser("users-index"))
        <a href="{{ routeHelper('departments.users.index', ['department' => $id]) }}" class="btn btn-outline-info dropdown-item">
            <i class="ft-list"></i> @lang('menu.list-rows', ['model' => trans('menu.users')])
        </a>
    @endif
@endsection
