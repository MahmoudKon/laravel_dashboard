@push('style')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endpush

<div class='row'>
    <div class="col-md-9">
        {{-- START title --}}
        <div class="form-group">
            <label class="required">@lang('inputs.title')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-header"></i> </span>
                </div>
                <input type="text" class="form-control" name="title" required value="{{ $row->title ?? old('title') }}"  placeholder="@lang('inputs.title')">
            </div>
            <x-validation-error input='title' />
        </div>
        {{-- END title --}}

        <div class="row">
            <div class="col-md-6">
                {{-- START start_date --}}
                <div class="form-group">
                    <label class="required">@lang('inputs.start_date')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                        </div>
                        <input type="text" class="form-control datetime" required name="start_date" id="start_date" value="{{ $row->start_date ?? old('start_date') }}"  placeholder="@lang('inputs.start_date')">
                    </div>
                    <x-validation-error input='start_date' />
                </div>
                {{-- END start_date --}}
            </div>

            <div class="col-md-6">
                {{-- START end_date --}}
                <div class="form-group">
                    <label class="required">@lang('inputs.end_date')</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                        </div>
                        <input type="text" class="form-control datetime" required name="end_date" id="end_date" value="{{ $row->end_date ?? old('end_date') }}"  placeholder="@lang('inputs.end_date')">
                    </div>
                    <x-validation-error input='end_date' />
                </div>
                {{-- END end_date --}}
            </div>
        </div>

        {{-- START url --}}
        <div class="form-group">
            <label class="required">@lang('inputs.url')</label>
            <label class="float-right">@lang('inputs.open_type')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-link"></i> </span>
                </div>
                <input type="url" class="form-control" name="url" required value="{{ $row->url ?? old('url') }}"  placeholder="@lang('inputs.url')">
                <div class="input-group-prepend">
                    <span class="input-group-text py-0">
                        <input type="checkbox" name="open_type" value="1" class="switchery" data-size="sm" @checked($row->open_type ?? (old('open_type')))>
                    </span>
                </div>
            </div>
            <x-validation-error input='url' />
        </div>
        {{-- END url --}}
    </div>

    <div class="col-md-3">
        {{-- START image --}}
        @include('backend.includes.forms.input-file', ['image' => isset($row) && $row->image ? url($row->image) : null, 'alt' => $row->name ?? null])
        {{-- END image --}}
    </div>
</div>

{{-- START desc --}}
<div class="form-group">
    <label>@lang("inputs.desc")</label>
    <textarea name="desc" class="ckeditor" placeholder='@lang("inputs.desc")'>{{ $row->desc ?? old("desc") }}</textarea>
    <x-validation-error input='desc' />
</div>
{{-- END desc --}}

@push('script')
    <script type="text/javascript" src="{{ assetHelper('vendors/js/editors/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/{{ app()->getLocale() }}.js"></script>
    <script>
        $(document).ready(function() {CKEDITOR.replaceAll('ckeditor'); });
        $(function() {
	        // Date & Time
            $('.datetime').flatpickr({enableTime: true, dateFormat: "Y-m-d H:i", locale: "{{ app()->getLocale() }}", minDate: new Date()});

            $('body').on('change', '#start_date', function(e) {
                let start_val = $(this).val();
                let to_ele   = $('body').find('#end_date');
                let to_val   = to_ele.val();
                if (start_val > to_val)
                    to_ele.val('').flatpickr({dateFormat: 'Y-m-d H:i', enableTime: true, minDate: start_val, enableTime: true});
                else
                    to_ele.val(to_ele.val()).flatpickr({dateFormat: 'Y-m-d H:i', enableTime: true, minDate: start_val, enableTime: true});
            });

        });
    </script>
@endpush
