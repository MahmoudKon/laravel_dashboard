<div class="row">
    <div class="col-md-8">
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

        {{-- START DEPARTMENT --}}
        <div class="form-group">
            <label class="required">@lang('inputs.select-data', ['data' => trans('menu.category')])</label>
            <select class="select2 form-control" name="parent_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.category')]) ---">
                <option value=" ">@lang('inputs.please-select')</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((isset($row) && $row->parent_id == $category->id) || $categories->count() == 1)>{{ $category->name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'parent_id'])
        </div>
        {{-- END DEPARTMENT --}}

    </div>

    <div class="col-md-4">
        @include('backend.includes.forms.input-file', ['image' => isset($row) && $row->image ? asset($row->image) : null, 'alt' => isset($row) ? $row->getName() : null])
    </div>
</div>
