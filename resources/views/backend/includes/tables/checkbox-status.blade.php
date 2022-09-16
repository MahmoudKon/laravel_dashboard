<form method='post' action='{{ routeHelper(getModel().'.column.toggle', [$row, $column]) }}' class='submit-form'>
    @csrf

    <div class="form-check form-switch form-check-custom form-check-solid">
        <input type="checkbox" class="form-check-input checkbox-change-status" @checked($row->$column)>
    </div>
</form>
