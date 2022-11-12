@push('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/pickers/daterange/daterangepicker.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/pickers/pickadate/pickadate.css') }}">
@endpush

<div class="row">

    {{-- START KEY --}}
    <div class="col-md-12">
        <div class="form-group">
            <label class="required">@lang('inputs.key')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-blue-grey bg-lighten-1 white"> <i class="la la-pencil"></i> </span>
                </div>
                <input type="text" class="form-control badge-text-maxlength" maxlength="30" name="key"
                    value="{{ $row->key ?? old('key') }}" placeholder="@lang('inputs.key')" autocomplete="off" required>
            </div>
            <x-validation-error input='key' />
        </div>
    </div>
    {{-- END KEY --}}

    {{-- START ACTIVE --}}
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('inputs.select-data', ['data' => trans('inputs.active')])</label>
            <select class="select2 form-control" name="active" id="active" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.content_type')]) ---" >
                @foreach ([1 => 'YES', 0 => 'NO'] as $index => $name)
                    <option value="{{ $index }}" @selected(isset($row) && $row->active === $index || old('active') === $index)>{{ $name }}</option>
                @endforeach
            </select>
            <x-validation-error input='active' />
        </div>
    </div>
    {{-- END ACTIVE --}}

    {{-- START CONTENT TYPE --}}
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('inputs.select-data', ['data' => trans('menu.content_type')])</label>
            <select class="select2 form-control" name="content_type_id" id="content_type_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.content_type')]) ---" >
                <option value="">@lang('inputs.please-select')</option>
                @foreach ($types as $id => $name)
                    <option value="{{ $id }}" @selected(isset($row) && $row->content_type_id == $id || old('content_type_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
            <x-validation-error input='content_type_id' />
        </div>
    </div>
    {{-- END CONTENT TYPE --}}
</div>

<div id="load-content-type-input" class="pt-2" style="border-top: 1px solid #d5d5d5"></div>

@push('script')
    <script src="{{ assetHelper('vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ assetHelper('vendors/js/pickers/pickadate/picker.date.js') }}"></script>
    <script src="{{ assetHelper('vendors/js/pickers/pickadate/picker.time.js') }}"></script>

    <script>
        $(function() {
            $(document).ready(function() {
                if ($('#content_type_id').val() > 0) { $('#content_type_id').change() }
            });

            let content_type_input = $('#load-content-type-input');
            let content_id = "{{ $row->id ?? null }}";
            $('body').on('change', '#content_type_id', function() {
                let url = "{{ routeHelper('settings.type.input') }}";
                let content_type_id = $(this).val();
                content_type_input.addClass('load').fadeOut(300, function () { $(this).empty() });

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {content_type_id: content_type_id, content_id: content_id},
                    success: function (response, textStatus, jqXHR) {
                        content_type_input.fadeIn(300, function() { $(this).html(response); });
                    },
                    error: function (jqXHR, textStatus, errorMessage) {
                        handleErrors(jqXHR);
                    },
                    complete: function() { content_type_input.removeClass('load'); }
                });

            });
        });
    </script>
@endpush

@push('script')
    <script src="{{ assetHelper('vendors/js/pickers/pickadate/picker.js') }}"></script>
    <script src="{{ assetHelper('vendors/js/pickers/pickadate/picker.date.js') }}"></script>

    <script>
        $(function() {
            let min = '2022-06-20';
            let max = '2022-06-24';
            $('.pickadate-selectors').pickadate({
                labelMonthNext: 'Next month',
                labelMonthPrev: 'Previous month',
                labelMonthSelect: 'Pick a Month',
                labelYearSelect: 'Pick a Year',
                selectMonths: true,
                selectYears: true,
                format: 'yyyy-mm-dd',
                min: min,
                max: max,
                today: 'Today',
                close: 'Close',
                clear: 'Clear'
            });
        });
    </script>
@endpush
