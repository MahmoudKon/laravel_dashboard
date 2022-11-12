<div class="nav-vertical">
    <ul class="nav nav-tabs nav-left nav-border-left">
        @foreach (config('languages') as $name => $lang)
            <li class="nav-item">
                <a class="nav-link {{ $loop->first ? "active" : "" }}" id="{{ $lang }}-title-tab" data-toggle="tab" aria-controls="{{ $lang }}" href="#title-{{ $lang }}" aria-expanded="true">@lang("menu.$name")</a>
            </li>
        @endforeach
    </ul>

    <div class="tab-content px-1">
        @foreach (config('languages') as $name => $lang)
            <div role="tabpanel" class="tab-pane tap- {{ $loop->first ? "active" : "" }}" id="title-{{ $lang }}" aria-expanded="true" aria-labelledby="{{ $lang }}-title-tab">
                <div class="form-group">
                    <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.title') / @lang("menu.$name")</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input type="text" class="form-control" name="title[{{ $lang }}]" value="{{ isset($row) ? $row->getTitle($lang) : old("title.$lang") }}" placeholder="@lang('inputs.title') / @lang("menu.$name")" {{ $lang == app()->getLocale() ? "" : "" }}>
                    </div>
                    <x-validation-error input='title-{{ $lang }}' />
                </div>
            </div>
        @endforeach
    </div>
</div>
