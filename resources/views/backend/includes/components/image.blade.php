<div class="col-md-6">
    <div id="file-preview">
        <div class="form-group">
            <label class="required">@lang("inputs.$name")</label>
            <div class="custom-file">
                <input type="file" class="custom-file-input cursor-pointer form-control" name="{{ $name }}" accept="image/*" onchange="previewFile(this)">
                <label class="custom-file-label" for="upload-image"><i class="fa fa-upload"></i> Choose Image</label>
            </div>
            <x-validation-error input='{{ $name }}' />
        </div>

        <img loading="lazy" src="{{ $value ? url($value) : 'https://www.lifewire.com/thmb/2KYEaloqH6P4xz3c9Ot2GlPLuds=/1920x1080/smart/filters:no_upscale()/cloud-upload-a30f385a928e44e199a62210d578375a.jpg' }}"
                    class="img-border img-thumbnail" id="show-file">
    </div>
</div>
