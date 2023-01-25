<span class="dropdown">
    <button id="table-optins" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
        class="btn btn-primary dropdown-toggle dropdown-menu-right"> <i class="fa-solid fa-screwdriver-wrench"></i> </button>
    <span aria-labelledby="table-optins" class="dropdown-menu mt-1 dropdown-menu-left" x-placement="bottom-end">

        @if (canUser(getModel()."-edit") && Route::has(getRoutePrefex('.').getModel().'.edit'))
            <a href="{{ routeHelper(getModel().'.edit', $id) }}" data-toggle="tooltip" title="@lang('buttons.edit')"
                class="btn btn-outline-primary {{ $use_button_ajax ? 'show-modal-form' : '' }} dropdown-item">
                <i class="fas fa-edit"></i> @lang('buttons.edit')
            </a>
        @endif

        @if (canUser(getModel()."-destroy") && Route::has(getRoutePrefex('.').getModel().'.destroy'))
            <form action="{{ routeHelper(getModel().'.destroy', $id) }}" method="POST" class="form-destroy">
                {{ csrf_field() }}
                @method('delete')
                <button type="submit" class="btn btn-outline-danger dropdown-item delete" data-toggle="tooltip" title="@lang('buttons.delete')">
                    <i class="fas fa-trash"></i> @lang('buttons.delete')
                </button>
            </form>
        @endif

        @yield('table-buttons')
    </span>
</span>
