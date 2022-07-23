{{-- START NAME --}}
<div class="form-group">
    <label class="required">@lang('inputs.name')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="la la-pencil"></i> </span>
        </div>
        <input type="text" class="form-control badge-text-maxlength" maxlength="30" name="name"
            value="{{ $row->name ?? old('name') }}" placeholder="@lang('inputs.name')" autocomplete="off" required>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "name"])
</div>
{{-- START NAME --}}

{{-- START NAME --}}
<div class="form-group">
    <label class="required">@lang('inputs.visible_to_content')</label>
    <select class="form-control select2" name="visible_to_content" required>
        <option value="1" @selected(isset($row) && $row->visible_to_content === 1 || old('visible_to_content'))>Visible</option>
        <option value="0" @selected(isset($row) && $row->visible_to_content === 0 || old('visible_to_content'))>Hidden</option>
    </select>
    @include('layouts.includes.backend.validation_error', ['input' => "name"])
</div>
{{-- START NAME --}}
