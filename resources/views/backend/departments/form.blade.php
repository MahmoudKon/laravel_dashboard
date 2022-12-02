{{-- START DEPARTMENT TITLE --}}
<div class="form-group">
    <label class="required">@lang('inputs.title')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa-solid fa-building-user"></i> </span>
        </div>
        <input type="text" class="form-control" name="title" value="{{ $row->title ?? old('title') }}" placeholder="@lang('inputs.title')" required>
    </div>
    <x-validation-error input='title' />
</div>
{{-- START DEPARTMENT TITLE --}}

{{-- START EMAIL --}}
<div class="form-group">
    <label class="required">@lang('inputs.email')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
        </div>
        <input type="email" class="form-control" name="email" value="{{ $row->email ?? old('email') }}" placeholder="@lang('inputs.email')" required>
    </div>
    <x-validation-error input='email' />
</div>
{{-- END  EMAIL --}}

{{-- START MANAGER --}}
<x-html.select name='manager_id' :list="$users"
:selected="old('manager_id', ($row->manager_id ?? null))"
:label="trans('inputs.select-data', ['data' => trans('inputs.manager')])" />
{{-- END MANAGER --}}
