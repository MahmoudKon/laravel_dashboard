<div class="col-md-6">
    <div class="form-group">
        <label class="required">@lang("inputs.$name")</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <a href="{{ url($value ?? '') }}" id="show-file" target="_blank" class="btn btn-sm btn-darken-2 input-group-text"> Preview </a>
            </div>

            <div class="custom-file">
                <input type="file" name="value" class="custom-file-input cursor-pointer form-control" onchange="previewFile(this)" accept="application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.csv, application/pdf, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                <label class="custom-file-label" for="upload-image"><i class="fa fa-upload"></i> Choose file</label>
            </div>
        </div>
        <x-validation-error input='{{ $name }}' />
    </div>
</div>
