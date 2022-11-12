{{-- START DEPARTMENT TITLE --}}
<div class="form-group">
    <label class="required">@lang('inputs.title')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa-solid fa-building-user"></i> </span>
        </div>
        <input type="text" class="form-control" name="title" value="{{ $row->title ?? old('title') }}" placeholder="@lang('inputs.title')" required>
    </div>
    <x-validation-error input='title' />
</div>
{{-- START DEPARTMENT TITLE --}}

{{-- START EMAIL --}}
<div class="form-group">
    <label class="required">@lang('inputs.email')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
        </div>
        <input type="email" class="form-control" name="email" value="{{ $row->email ?? old('email') }}" placeholder="@lang('inputs.email')" required>
    </div>
    <x-validation-error input='email' />
</div>
{{-- END  EMAIL --}}

{{-- START MANAGER --}}
<div class="form-group">
    <label class="required">@lang('inputs.select-data', ['data' => trans('inputs.manager')])</label>
    <select class="select2 form-control w-100" name="manager_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.manager')]) ---" required>
        <option value="">@lang('inputs.please-select')</option>
        @foreach ($users as $id => $name)
            <option value="{{ $id }}" @selected(isset($row) && $row->manager_id == $id || old('manager_id') == $id)>{{ $name }}</option>
        @endforeach
    </select>
    <x-validation-error input='manager_id' />
</div>
{{-- END MANAGER --}}

{{-- START MANAGER OF MANAGER --}}
<div class="form-group">
    <label>@lang('inputs.select-data', ['data' => trans('inputs.manager-of-manager')])</label>
    <select class="select2 form-control w-100" name="manager_of_manager_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.manager-of-manager')]) ---">
        <option value="">@lang('inputs.please-select')</option>
        @foreach ($users as $id => $name)
            <option value="{{ $id }}" @selected(isset($row) && $row->manager_of_manager_id == $id || old('manager_of_manager_id') == $id)>{{ $name }}</option>
        @endforeach
    </select>
    <x-validation-error input='manager_of_manager_id' />
</div>
{{-- END MANAGER OF MANAGER --}}
