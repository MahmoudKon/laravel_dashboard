@if (canUser("cities-index"))
    <a href="{{ routeHelper(getModel().'.cities.index', $id) }}" class="btn btn-outline-info btn-sm">
        <i class="fa fa-list"></i> @lang('menu.list-rows', ['model' => trans('menu.cities')])
    </a>
@endif

@if (canUser("cities-create"))
    <a href="{{ routeHelper(getModel().'.cities.create', $id) }}" class="btn btn-outline-warning btn-sm show-modal-form">
        <i class="fa fa-plus"></i> @lang('menu.create-row', ['model' => trans('menu.city')])
    </a>
@endif