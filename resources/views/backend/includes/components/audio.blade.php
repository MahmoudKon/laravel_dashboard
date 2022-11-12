<div class="col-md-6">
    <div class="form-group">
        <label class="required">@lang("inputs.$name")</label>
        <div class="custom-file">
            <input type="file" class="custom-file-input cursor-pointer form-control" name="{{ $name }}" accept="audio/*" onchange="previewFile(this)">
            <label class="custom-file-label" for="upload-image"><i class="fa fa-upload"></i> Choose Audio</label>
        </div>
        <x-validation-error input='{{ $name }}' />
    </div>

    <audio controls class="w-100"> <source id="show-file" src="{{ url($value ?? '') }}"> </audio>
</div>
