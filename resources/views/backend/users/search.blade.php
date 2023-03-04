<div class="row">
    <div class="col-md-12">
        {{-- START USER NAME --}}
        <div class="form-group">
            <label>@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input type="text" class="form-control" name="name" placeholder="@lang('inputs.name')">
            </div>
        </div>
        {{-- START USER NAME --}}

        {{-- START EMAIL --}}
        <div class="form-group">
            <label>@lang('inputs.email')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input type="text" class="form-control" name="email" placeholder="@lang('inputs.email')">
            </div>
        </div>
        {{-- END  EMAIL --}}

        {{-- START ROLES --}}
        <div class="form-group">
            <label>@lang('inputs.select-data', ['data' => trans('menu.roles')])</label>
            <select class="form-control" name="role">
                <option value="0">--- @lang('inputs.select-data', ['data' => trans('menu.roles')]) ---</option>
                @foreach ($roles as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
        </div>
        {{-- END ROLES --}}
    </div>
</div>
