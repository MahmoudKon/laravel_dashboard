{{-- START TITLE --}}
<div class="form-group">
    <label class="required">@lang('inputs.title')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="la la-pencil"></i> </span>
        </div>
        <input type="text" class="form-control badge-text-maxlength" maxlength="30" name="title"
            value="{{ $row->title ?? old('title') }}" placeholder="@lang('inputs.title')" autocomplete="off" required>
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "title"])

</div>
{{-- START TITLE --}}

{{-- START RATIO --}}
<div class="form-group">
    <label>@lang('inputs.ratio')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> % </span>
        </div>
        <input type="number" min="0.00" step="0.01" max=".99" class="form-control badge-text-maxlength" maxlength="4" name="ratio"
            value="{{ $row->ratio ?? old('ratio') }}" autocomplete="off" placeholder="@lang('inputs.ratio')">
    </div>
    @include('layouts.includes.backend.validation_error', ['input' => "ratio"])
</div>
{{-- START RATIO --}}
