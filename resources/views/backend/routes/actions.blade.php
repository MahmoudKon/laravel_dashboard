@if (canUser(getModel()."-edit"))
    <a href="{{ routeHelper(getModel().'.edit', $id) }}" class="btn btn-outline-info dropdown-item show-modal-form">
        <i class="fa fa-link"></i> @lang('buttons.assign-roles')
    </a>
@endif
