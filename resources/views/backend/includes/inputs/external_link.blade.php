<div class="form-group">
    <label class="required">@lang('inputs.external-link')</label>
    <input type="url" class="form-control" name="{{ $column_name ?? 'data' }}" placeholder="www.google.com">
    <x-validation-error input='{{ $column_name ?? 'value' }}' />
</div>
