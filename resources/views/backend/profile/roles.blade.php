{{-- END ROLES --}}
<div class="col-md-12">
    <div class="form-group">
        <label>@lang('inputs.select-data', ['data' => trans('menu.roles')])</label>

        <button type="button" class="btn btn-sm btn-grey-blue select-all-options float-right" }}">un/select all</button>

        <select class="select2 form-control" id="roles" name="roles[]" multiple data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.roles')]) ---">
            {{-- <option value="">@lang('inputs.please-select')</option> --}}
            @foreach ($roles as $id => $name)
                <option value="{{ $id }}" @selected((isset($user) && $user->hasRole($name)))>{{ $name }}</option>
            @endforeach
        </select>
        <x-validation-error input='roles' />
    </div>
</div>
{{-- END ROLES --}}
