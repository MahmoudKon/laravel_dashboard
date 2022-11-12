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
    <x-validation-error input='name' />
</div>
{{-- START PERMISSION NAME --}}
