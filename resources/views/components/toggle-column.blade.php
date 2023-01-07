<form method='post' action='{{ routeHelper(getModel().'.column.toggle', [$id, $column]) }}' class='submit-form'>
    @csrf

    <div class="form-check form-switch form-check-custom form-check-solid">
        <input type="checkbox" class="switchery checkbox-change-status" @checked($value)>
    </div>
</form>
