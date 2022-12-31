<div class="row">

    <div class="col-md-12">
        <div class="nav-vertical">
            <ul class="nav nav-tabs nav-only-icon nav-top-border no-hover-bg nav-justified">
                @foreach (config('languages') as $name => $lang)
                    <li class="nav-item">
                        <a class="nav-link {{ $loop->first ? "active" : "" }}" id="{{ time().'-'.$lang }}-name-tab" data-toggle="tab" aria-controls="{{ $lang }}" href="#name-{{ time().'-'.$lang }}" aria-expanded="true">{{ $name }}</a>
                    </li>
                @endforeach
            </ul>

            <div class="tab-content px-1">
                @foreach (config('languages') as $name => $lang)
                    <div role="tabpanel" class="tab-pane tap- {{ $loop->first ? "active" : "" }}" id="name-{{ time().'-'.$lang }}" aria-expanded="true" aria-labelledby="{{ time().'-'.$lang }}-name-tab">
                        <div class="form-group">
                            <label class="{{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.name') / {{ $name }}</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input type="text" class="form-control" name="name[{{ $lang }}]" value="{{ isset($row) ? $row->getName($lang) : old("name.$lang") }}" placeholder="@lang('inputs.name') / {{ $name }}" {{ $lang == app()->getLocale() ? "" : "" }}>
                            </div>
                            <x-validation-error input='name-{{ $lang }}' />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
