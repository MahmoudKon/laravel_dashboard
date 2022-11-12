<div class="form-group">
    <label class="required">@lang("inputs.$name")</label>
    <input type="text" class="form-control" name="{{ $name }}" value="{{ $value ?? old($name) }}" placeholder='@lang("inputs.$name")' required>
    <x-validation-error input='{{ $name }}' />
</div>
