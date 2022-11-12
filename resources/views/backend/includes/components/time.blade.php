{{-- START WEEKEND DAYS --}}
<div class="col-md-6">
    <div class="form-group">
        <label class="required">@lang("inputs.$name")</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-blue-grey bg-lighten-1 border-blue-grey white"> <i class="fa fa-clock"></i> </span>
            </div>
            <input type="text" name="{{ $name }}" class="form-control select-time" placeholder="Select Time" value="{{ $value ?? old($name) }}">
        </div>
        <x-validation-error input='{{ $name }}' />
    </div>
</div>
{{-- END WEEKEND DAYS --}}

<script>
    $(function() {
        $('.select-time').pickatime({
            format: 'h:i A',
            formatLabel: 'h:i A',
            min: '11:00 AM',
            max: '05:00 PM',
            step: 5,
        });
    });
</script>
