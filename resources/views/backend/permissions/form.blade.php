{{-- START PERMISSION NAME --}}
<div class="form-group">
    <label class="required">@lang('inputs.name')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="la la-pencil"></i> </span>
        </div>
        <input type="text" class="form-control badge-text-maxlength" maxlength="40" name="name"
            value="{{ $row->name ?? old('name') }}" placeholder="@lang('inputs.name')" autocomplete="off" required>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => 'name'])
</div>
{{-- START PERMISSION NAME --}}

{{-- START ROLES --}}
<div class="form-group">
    <label>@lang('inputs.access-data', ['model' => trans('menu.roles')])</label>
    <select class="select2 form-control w-100" name="roles[]" data-placeholder="--- @lang('inputs.access-data', ['model' => trans('menu.roles')]) ---" multiple>
        {{-- <option value="">@lang('inputs.please-select')</option> --}}
        @foreach ($roles as $id => $name)
        <option value="{{ $id }}" @selected(isset($row) && $row->hasRole($name))>{{ $name }}</option>
        @endforeach
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => 'roles'])
</div>
{{-- END ROLES --}}
