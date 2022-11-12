<script type="text/javascript" src="{{ assetHelper('vendors/js/editors/ckeditor/ckeditor.js') }}"></script>
<script>
    $(document).ready(function() {CKEDITOR.replaceAll('ckeditor'); });
</script>

@if (isset($column_name) || $column_name == "value")

<div class="form-group">
    <label>@lang('inputs.value')</label>
    <textarea name="value" cols="30" rows="15" class="ckeditor" placeholder="@lang('inputs.value')">{{ $row->value ?? old("value") }}</textarea>
    <x-validation-error input='value' />
</div>

@else
    <div class="nav-vertical">
        <ul class="nav nav-tabs nav-left nav-border-left">
            @foreach (config('languages') as $name => $lang)
                <li class="nav-item">
                    <a class="nav-link {{ $loop->first ? "active" : "" }}" id="{{ $lang }}-data-tab" data-toggle="tab" aria-controls="{{ $lang }}" href="#data-{{ $lang }}" aria-expanded="true">@lang("menu.$name")</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content px-1">
            @foreach (config('languages') as $name => $lang)
                <div role="tabpanel" class="tab-pane tap- {{ $loop->first ? "active" : "" }}" id="data-{{ $lang }}" aria-expanded="true" aria-labelledby="{{ $lang }}-data-tab">
                    <div class="form-group">
                        <label>@lang('inputs.content') / @lang("menu.$name")</label>
                        <textarea name="data[{{ $lang }}]" cols="30" rows="15" class="ckeditor" placeholder="@lang('inputs.content') / @lang("menu.$name")" {{ $lang == app()->getLocale() ? "" : "" }}>{{ isset($row) ? $row->getData($lang) : old("data.$lang") }}</textarea>
                        <x-validation-error input='data-{{ $lang }}' />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
