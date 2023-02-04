{{-- END FORM INPUTS --}}
<div class="form-group">
    <label for="file" class="required block-tag">Select Excel File</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-file-excel"></i> </span>
        </div>
        <input type="file" class="form-control" name="file" id="file" required>
    </div>
    <x-validation-error input='file' />
    <p class="badge-default badge-info block-tag text-center">
        Please Upload Only Excel File
    </p>
</div>
{{-- END FORM INPUTS --}}