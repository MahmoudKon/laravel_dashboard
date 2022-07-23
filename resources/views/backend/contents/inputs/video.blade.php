<div class="form-group">
    <label class="required">@lang('inputs.video')</label>
    <input type="file" class="form-control" name="data" accept="video/*">
    <small class="warning"><i class="fa fa-warning"></i> Only <b>mp4</b> Extentions <i class="fa fa-warning"></i></small>
    @include('layouts.includes.backend.validation_error', ['input' => "data"])
</div>


<div class="row">

    <div class="col-md-3">
        {{-- START CONTENT IMAGE --}}
        @include('backend.includes.forms.input-file', ['image' => isset($row) ? asset($row->video_thumb) : null, 'alt' => $row->title ?? null, 'class' => 'required', 'required' => false])
        {{-- START CONTENT IMAGE --}}
    </div>


    @if ($row)
        <div class="col-md-3">
            {!! $row->getDataHtml() !!}
        </div>
    @endif

</div>
