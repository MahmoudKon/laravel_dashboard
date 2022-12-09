@if (isset($column_name) && $column_name == 'value')

<div class="col-md-3">
    {{-- START CONTENT IMAGE --}}
    <div class="form-group">
        <label class="{{ $class ?? '' }}">@lang('inputs.upload-image')</label>
        <div id="file-preview">
            <input type="file" name="value" class="form-control input-image" accept="image/*" onchange="previewFile(this)" {{ isset($required) && $required ? "required" : "" }}>
            <div>
                <img loading="lazy" src="{{ isset($row) ? asset($row->data) : 'https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg' }}"
                    class="img-border img-thumbnail" id="show-file" alt="{{ $row->value ?? "Image" }}">
            </div>
        </div>
        <x-validation-error input='value' />
    </div>
    {{-- START CONTENT IMAGE --}}
</div>


@else
    <div class="col-md-3">
        {{-- START CONTENT IMAGE --}}
        <div class="form-group">
            <label class="{{ $class ?? '' }}">@lang('inputs.upload-image')</label>
            <div id="file-preview">
                <input type="file" name="data" class="form-control input-image" accept="image/*" onchange="previewFile(this)" {{ isset($required) && $required ? "required" : "" }}>
                <div>
                    <img loading="lazy" src="{{ isset($row) ? asset($row->data) : 'https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg' }}"
                        class="img-border img-thumbnail" id="show-file" alt="{{ $row->title ?? "Image" }}">
                </div>
            </div>
            <x-validation-error input='data' />
        </div>
        {{-- START CONTENT IMAGE --}}
    </div>
@endif
