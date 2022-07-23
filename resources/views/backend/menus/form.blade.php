<div class="card-header bg-primary">
    <h4 class="card-title white">
        <i class="ft-edit"></i><span class="mx-1">{{ $title }}</span>
    </h4>
</div>

<div class="card-content collpase show">
    <div class="card-body">
        @if (isset($row))
        <form action="{{ routeHelper('menus.update', $row) }}" method="post" class="submit-form">
            @method("PUT")
        @else
        <form action="{{ routeHelper("menus.store") }}" method="post" class="submit-form">
        @endif
            @csrf
            <input type="hidden" name="id" value="{{ $row->id ?? '' }}">

            @foreach (config('languages') as $lang)
                {{-- START NAME --}}
                <div class="form-group">
                    <label class=" {{ $lang == app()->getLocale() ? "required" : "" }}">@lang('inputs.name') / {{ $lang }}</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="la la-pencil"></i> </span>
                        </div>
                        <input type="text" class="form-control badge-text-maxlength" maxlength="30" name="name[{{ $lang }}]"
                            value="{{ isset($row) ? $row->getName($lang) : old("name.$lang") }}" placeholder="@lang('inputs.name') / {{ $lang }}" autocomplete="off" {{ $lang == app()->getLocale() ? "" : "" }}>
                    </div>
                    @include('layouts.includes.backend.validation_error', ['input' => "name-$lang"])
                </div>
                {{-- START NAME --}}
            @endforeach

            <div class="row">

                <div class="col-md-8">
                    {{-- START ROUTE --}}
                    <div class="form-group">
                        <label>@lang('inputs.route')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="fa-solid fa-link"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="route" value="{{ $row->route ?? old('route') }}"  placeholder="users.index">
                        </div>
                        @include('layouts.includes.backend.validation_error', ['input' => 'route'])
                    </div>
                    {{-- END ROUTE --}}
                </div>

                <div class="col-md-4">
                    {{-- START ICON --}}
                    <div class="form-group">
                        <label>@lang('inputs.icon')</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"> <i class="{{ $row->icon ?? '' }}"></i> </span>
                            </div>
                            <input type="text" class="form-control" name="icon" value="{{ $row->icon ?? old('icon') }}"  placeholder="users.index">
                        </div>
                        @include('layouts.includes.backend.validation_error', ['input' => 'icon'])
                    </div>
                    {{-- END ICON --}}
                </div>

            </div>

            {{-- START AGGREGATORS --}}
            <div class="form-group">
                <label>@lang('inputs.select-data', ['data' => trans('menu.menu')])</label>
                <select class="select2 form-control" name="parent_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.menu')]) ---">
                    <option value="">@lang('inputs.please-select')</option>
                    @foreach ($menus as $menu)
                        <option value="{{ $menu->id }}" @selected((isset($row) && $row->parent_id == $menu->id) || ($check ?? false))>{{ $menu->name }}</option>
                    @endforeach
                </select>
                @include('layouts.includes.backend.validation_error', ['input' => 'parent_id'])
            </div>
            {{-- END AGGREGATORS --}}

            {{-- END FORM BUTTONS --}}
            @include('backend.includes.buttons.form-buttons')
            {{-- END FORM BUTTONS --}}
        </form>
    </div>
</div>
