@if (isset($column_name) && $column_name == 'value')
    <div class="form-group">
        <label class="required">@lang('inputs.value')</label>
        <input type="text" class="form-control" name="value" value="{{ $row->value ?? old("value") }}" placeholder="@lang('inputs.value')">
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
                        <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.content') / @lang("menu.$name")</label>
                        <input type="text" class="form-control" name="data[{{ $lang }}]" value="{{ isset($row) ? $row->getData($lang) : old("data.$lang") }}" placeholder="@lang('inputs.content') / @lang("menu.$name")" {{ $lang == app()->getLocale() ? "" : "" }}>
                        <x-validation-error input='data-{{ $lang }}' />
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif
