{{-- START SELECTOR --}}
<div class="col-md-6">
    <div class="form-group">
        <label class="required">@lang("inputs.$name")</label>
        <select class="select2 form-control" name="{{ $name }}" data-placeholder='--- @lang("inputs.$name") ---' required>
            @foreach (config('languages') as $name => $lang)
                <option value="{{ $lang }}" @selected(isset($value) && $value == $lang || old($lang) === $lang)>{{ ucfirst($name) }}</option>
            @endforeach
        </select>
        <x-validation-error input='{{ $name }}' />
    </div>
</div>
{{-- END SELECTOR --}}

<script>
    $(function() {
        $('.select2').select2();
    });
</script>
