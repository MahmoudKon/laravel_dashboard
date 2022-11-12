<div class="form-group">
    <label class="required">@lang('inputs.video')</label>
    <input type="file" class="form-control" name="data" accept="video/*">
    <small class="warning"><i class="fa fa-warning"></i> Only <b>mp4</b> Extentions <i class="fa fa-warning"></i></small>
    <x-validation-error input='{{ $column_name ?? "data" }}' />
</div>

<div class="col-md-3">
    {{-- START CONTENT IMAGE --}}
    @include('backend.includes.forms.input-file', ['image' => $row->video_thumb ?? ($row->value ?? null), 'alt' => $row->title ?? ($row->value ?? null), 'class' => 'required', 'required' => false])
    {{-- START CONTENT IMAGE --}}
</div>
