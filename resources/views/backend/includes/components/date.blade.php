{{-- START WEEKEND DAYS --}}
<div class="col-md-6">
    <div class="form-group">
        <label class="required">@lang("inputs.$name")</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text bg-blue-grey bg-lighten-1 border-blue-grey white"> <i class="fa fa-calendar"></i> </span>
            </div>
            <input type="text" name="{{ $name }}" class="form-control select-date" placeholder="Select Date" value="{{ $value ?? old($name) }}">
        </div>
        <x-validation-error input='{{ $name }}' />
    </div>
</div>
{{-- END WEEKEND DAYS --}}

<script>
    $(function() {
        $('.select-date').pickadate({
            labelMonthNext: 'Next month',
            labelMonthPrev: 'Previous month',
            labelMonthSelect: 'Pick a Month',
            labelYearSelect: 'Pick a Year',
            selectMonths: true,
            selectYears: true,
            format: 'yyyy-mm-dd',
            today: 'Today',
            close: 'Close',
            clear: 'Clear'
        });
    });
</script>
