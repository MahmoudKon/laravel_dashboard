<div class="form-group">
    <label class="required">@lang("inputs.$name")</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text bg-blue-grey border-blue-grey white"> <i class="fa fa-link"></i> </span>
        </div>
        <input type="url" class="form-control" name="{{ $name }}" placeholder="EX: www.google.com" value="{{ $value ?? old($name) }}">
    </div>
    <x-validation-error input='{{ $name }}' />
</div>


