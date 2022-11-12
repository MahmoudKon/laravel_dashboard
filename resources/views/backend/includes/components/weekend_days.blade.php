{{-- START WEEKEND DAYS --}}
<div class="col-md-6">
    <div class="form-group">
        <label class="required">@lang("inputs.$name")</label>
        <select class="select2 form-control" name="{{ $name }}[]" multiple data-placeholder="--- Select Days ---" required>
            @foreach (getDays() as $index => $day)
                <option value="{{ $index }}" {{ isset($value) && in_array($index, explode(',', $value)) ? "selected" : '' }}>{{ $day }}</option>
            @endforeach
        </select>
        <x-validation-error input='{{ $name }}' />
    </div>
</div>
{{-- END WEEKEND DAYS --}}

<script>
    $(function() {
        $('.select2').select2();
    });
</script>
