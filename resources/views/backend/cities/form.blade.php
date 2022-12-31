<div class="row">

    <div class="col-md-12">
        <div class="nav-vertical">
            <ul class="nav nav-tabs nav-only-icon nav-top-border no-hover-bg nav-justified">
                @foreach (config('languages') as $name => $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? "active" : "" }}" id="{{ $lang }}-name-tab" data-toggle="tab" aria-controls="{{ $lang }}" href="#name-{{ $lang }}" aria-expanded="true">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content px-1 my-2">
                @foreach (config('languages') as $name => $lang)
                    <div role="tabpanel" class="tab-pane tap- {{ $loop->first ? "active" : "" }}" id="name-{{ $lang }}" aria-expanded="true" aria-labelledby="{{ $lang }}-name-tab">
                        <div class="form-group">
                            <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.name') / {{ $name }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="name[{{ $lang }}]" value="{{ isset($row) ? $row->getName($lang) : old("name.$lang") }}" placeholder="@lang('inputs.name') / {{ $name }}" {{ $lang == app()->getLocale() ? "" : "" }}>
                            </div>
                            <x-validation-error input="name-{{ $lang }}" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="col-md-12">
        {{-- START GOVERNORATE --}}
        <div class="form-group">
            <label>@lang('inputs.select-data', ['data' => trans('menu.governorate')])</label>
            <select class="select2 form-control" id="governorate" name="governorate_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.governorate')]) ---">
                <option value="">@lang('inputs.please-select')</option>
                @foreach ($governorates as $id => $name)
                    <option value="{{ $id }}" @selected( (isset($row) && $row->governorate_id == $id) || count($governorates) == 1 )>{{ $name }}</option>
                @endforeach
            </select>
            <x-validation-error input="governorate_id" />
        </div>
        {{-- END GOVERNORATE --}}
    </div>

</div>

