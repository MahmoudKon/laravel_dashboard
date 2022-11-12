{{-- END PERMISSIONS --}}
<div class="col-md-12">
    <div class="form-group">
        <label>@lang('inputs.select-data', ['data' => trans('menu.permissions')])</label>

        <button type="button" class="btn btn-sm btn-grey-blue select-all-options float-right" }}">un/select all</button>

        <select class="select2 form-control" id="permissions" name="permissions[]" multiple data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.permissions')]) ---">
            {{-- <option value="">@lang('inputs.please-select')</option> --}}
            @foreach ($permissions as $id => $name)
                <option value="{{ $id }}" @selected((isset($user) && $user->haspermission($name)))>{{ $name }}</option>
            @endforeach
        </select>
        <x-validation-error input='permissions' />
    </div>
</div>
{{-- END PERMISSIONS --}}
