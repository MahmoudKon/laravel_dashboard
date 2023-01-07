@push('style')
    <link rel="stylesheet" type="text/css" href="{{ assetHelper('vendors/css/forms/selects/select2.min.css') }}">
@endpush

{{-- START URI --}}
<div class="form-group">
    <label>@lang('inputs.uri')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fas fa-anchor"></i> </span>
        </div>
        <input class="form-control" value="{{ $row->uri ?? '' }}" disabled readonly>
    </div>
</div>
{{-- START URI --}}

<div class="row">
    {{-- START CONTROLLER --}}
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('inputs.controller')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-gamepad"></i> </span>
                </div>
                <input class="form-control" value="{{ $row->controller ?? '' }}" disabled readonly>
            </div>
        </div>
    </div>
    {{-- START CONTROLLER --}}

    {{-- START FUNCTION --}}
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('inputs.function')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-hashtag"></i> </span>
                </div>
                <input class="form-control" value="{{ $row->func ?? '' }}" disabled readonly>
            </div>
        </div>
    </div>
    {{-- START FUNCTION --}}

    {{-- START METHOD --}}
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('inputs.method')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-meteor"></i> </span>
                </div>
                <input class="form-control" value="{{ $row->method ?? '' }}" disabled readonly>
            </div>
        </div>
    </div>
    {{-- START METHOD --}}
</div>

{{-- START ROLES --}}
<div class="form-group">
    <label>
        @lang('inputs.access-data', ['model' => trans('menu.roles')])
    </label>
    <button type="button" class="btn btn-sm btn-success select-all-options float-right">un/select all</button>
    <select class="select2 form-control w-100" name="roles[]" data-placeholder="--- @lang('inputs.access-data', ['model' => trans('menu.roles')]) --- " multiple>
        @foreach ($roles as $id => $name)
        <option value="{{ $id }}" @selected(isset($row) && $row->hasRole($id))>{{ $name }}</option>
        @endforeach
    </select>
    <x-validation-error input='permissions' />
</div>
{{-- END ROLES --}}

@push('script')
    <script type="text/javascript" src="{{ assetHelper('js/scripts/forms/select/form-select2.js') }}"></script>
@endpush
