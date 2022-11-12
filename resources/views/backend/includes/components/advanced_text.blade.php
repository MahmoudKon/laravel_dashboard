<script type="text/javascript" src="{{ assetHelper('vendors/js/editors/ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {CKEDITOR.replaceAll('ckeditor'); });
</script>

<div class="form-group">
    <label>@lang("inputs.$name")</label>
    <textarea name="{{ $name }}" cols="{{ $cols ?? 15 }}" rows="{{ $rows ?? 10 }}" class="ckeditor" placeholder='@lang("inputs.$name")' {{ $required ?? '' }}>{{ $value ?? old("$name") }}</textarea>
    <x-validation-error input='{{ $name }}' />
</div>
