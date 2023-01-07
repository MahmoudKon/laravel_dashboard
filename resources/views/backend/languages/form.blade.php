<div class='row'>
    <div class="col-md-6">
        {{-- START name --}}
        <div class="form-group">
            <label>@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" readonly value="{{ $row->name }}">
            </div>
        </div>
        {{-- END name --}}
    </div>

    <div class="col-md-6">
        {{-- START native --}}
        <div class="form-group">
            <label>@lang('inputs.native')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" readonly value="{{ $row->native }}">
            </div>
        </div>
        {{-- END native --}}
    </div>

    <div class="col-md-6">
        {{-- START short_name --}}
        <div class="form-group">
            <label>@lang('inputs.short_name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" readonly value="{{ $row->short_name }}">
            </div>
        </div>
        {{-- END short_name --}}
    </div>

    <div class="col-md-6">
        {{-- START ICON --}}
        <div class="form-group">
            <label>@lang('inputs.select-data', ['data' => trans('inputs.icon')])</label>
            <select name="icon" class="select2-icons form-control" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.icon')]) ---">
                <option></option>
                @foreach ($icons as $key => $value)
                    <option value="{{ $key }}" data-icon="{{ $key }}" @selected( isset($row) && $row->icon == $key || old('icon') == $key )>
                        {{ $value }}
                    </option>
                @endforeach
            </select>
            <x-validation-error input="icon" />
        </div>
        {{-- END ICON --}}
    </div>
</div>
