<div class="form-actions d-flex m-0" style="justify-content: space-evenly;">
    <button type="reset" class="btn btn-warning" data-dismiss="modal" data-toggle="tooltip" title="@lang('buttons.reset-form')">
        <i class="ft-repeat"></i> @lang('buttons.reset')
    </button>

    <button type="submit" class="btn btn-primary" data-toggle="tooltip" title="@lang('buttons.submit-form')">
        <i class="fa fa-save"></i> @lang('buttons.save')
    </button>
    
    @yield('form-buttons')
</div>
