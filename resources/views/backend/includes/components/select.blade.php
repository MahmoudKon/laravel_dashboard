{{-- START SELECTOR --}}
<div class="col-md-6">
    <div class="form-group">
        <label class="required">@lang("inputs.$name")</label>
        <select class="select2 form-control" name="{{ $name }}" data-placeholder='--- @lang("inputs.$name") ---' required>
            @foreach ([1 => 'TRUE', 0 => 'FALSE'] as $index => $val)
                <option value="{{ $index }}" @selected(isset($value) && $value == $index || old($name) === $index)>{{ $val }}</option>
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
