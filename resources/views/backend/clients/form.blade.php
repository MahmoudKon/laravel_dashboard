@push('style')
    {{-- CSS Style --}}
@endpush


<div class='row'>
        <div class="col-md-12">
        {{-- START name --}}
        <div class="form-group">
            <label>@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" name="name" required value="{{ $row->name ?? old('name') }}"  placeholder="@lang('inputs.name')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'name'])
        </div>
        {{-- END name --}}
    </div>


    <div class="col-md-12">
        {{-- START email --}}
        <div class="form-group">
            <label>@lang('inputs.email')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" name="email" required value="{{ $row->email ?? old('email') }}"  placeholder="@lang('inputs.email')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'email'])
        </div>
        {{-- END email --}}
    </div>


    <div class="col-md-12">
        {{-- START image --}}
        <div class="form-group">
            <label>@lang('inputs.image')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-pencil"></i> </span>
                </div>
                <input type="text" class="form-control" name="image"  value="{{ $row->image ?? old('image') }}"  placeholder="@lang('inputs.image')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'image'])
        </div>
        {{-- END image --}}
    </div>


    <div class="col-md-12">
        {{-- START active --}}
        <div class="form-group">
            <div>
                <label class="required">@lang('inputs.active')</label>
                <input type="checkbox" name="active" value="1" class="switchery" @checked($row->active ?? (old('active')))>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'active'])
        </div>
        {{-- END active --}}
    </div>



    <div class="col-md-12">
        {{-- START users --}}
        <div class="form-group">
            <label>@lang('inputs.select-data', ['data' => trans('menu.users')])</label>
            <select class="select2 form-control" id="users" name="user_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.users')]) ---" required>
                {{-- <option value="">@lang('inputs.please-select')</option> --}}
                @foreach ($users as $id => $name)
                    <option value="{{ $id }}" @selected(isset($row) && $row->user_id == $id)>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'user_id'])
        </div>
        {{-- END users --}}
    </div>


    <div class="col-md-12">
        {{-- START departments --}}
        <div class="form-group">
            <label>@lang('inputs.select-data', ['data' => trans('menu.departments')])</label>
            <select class="select2 form-control" id="departments" name="department_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.departments')]) ---" >
                {{-- <option value="">@lang('inputs.please-select')</option> --}}
                @foreach ($departments as $id => $name)
                    <option value="{{ $id }}" @selected(isset($row) && $row->department_id == $id)>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'department_id'])
        </div>
        {{-- END departments --}}
    </div>



</div>


@push('script')
    {{-- JS Code --}}
@endpush
