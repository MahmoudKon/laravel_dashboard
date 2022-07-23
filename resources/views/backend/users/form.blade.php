<div class="row">
    <div class="col-md-9">

        {{-- START USER NAME --}}
        <div class="form-group">
            <label class="required">@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                </div>
                <input type="text" class="form-control" name="name" value="{{ $row->name ?? old('name') }}" placeholder="@lang('inputs.name')" required>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'name'])
        </div>
        {{-- START USER NAME --}}

        {{-- START EMAIL --}}
        <div class="form-group">
            <label class="required">@lang('inputs.email')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input type="email" class="form-control" name="email" value="{{ $row->email ?? old('email') }}" placeholder="@lang('inputs.email')" required>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'email'])
        </div>
        {{-- END  EMAIL --}}

        {{-- START PASSWORD --}}
        <div class="form-group">
            <label class="{{ isset($row) ? '' : 'required' }}">@lang('inputs.password')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text show-password"> <i class="fas fa-lock"></i> </span>
                </div>
                <input type="password" class="form-control" name="password" placeholder=" @lang('inputs.password')" {{ isset($row) ? '' : 'required' }}>
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'password'])
        </div>
        {{-- END PASSWORD --}}

    </div>

    <div class="col-md-3">
        {{-- START USER IMAGE --}}
        @include('backend.includes.forms.input-file', ['image' => isset($row) && $row->image ? url($row->image) : null, 'alt' => $row->name ?? null])
        {{-- START USER IMAGE --}}
    </div>

    <div class="col-md-4">
        {{-- START ANNUAL CREDIT --}}
        <div class="form-group">
            <label>@lang('inputs.annual-credit')</label>
            <div class="input-group">
                <input type="number" min="0" name="annual_credit" class="touchspin-color" value="{{ $row->annual_credit ?? old('annual_credit') }}" placeholder="@lang('inputs.annual-credit')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'annual_credit'])
        </div>
        {{-- END ANNUAL CREDIT --}}
    </div>

    <div class="col-md-4">
        {{-- START FINGER PRINT ID --}}
        <div class="form-group">
            <label>@lang('inputs.finger-print-id')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-fingerprint"></i> </span>
                </div>
                <input type="number" min="1" class="touchspin-color" name="finger_print_id" value="{{ $row->finger_print_id ?? old('finger_print_id') }}" placeholder="@lang('inputs.finger-print-id')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'finger_print_id'])
        </div>
        {{-- END FINGER PRINT ID --}}
    </div>

    <div class="col-md-4">
        {{-- START SALARY PER MONTHLY --}}
        <div class="form-group">
            <label>@lang('inputs.salary')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-money-bill-1"></i> </span>
                </div>
                <input type="number" min="0" class="touchspin-color" name="salary_per_monthly" value="{{ $row->salary_per_monthly ?? old('salary_per_monthly') }}"  placeholder="@lang('inputs.salary')">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'salary_per_monthly'])
        </div>
        {{-- END SALARY PER MONTHLY --}}
    </div>

    <div class="col-md-4">
        {{-- START DEPARTMENT --}}
        <div class="form-group">
            <label class="required">@lang('inputs.select-data', ['data' => trans('menu.department')])</label>
            <select class="select2 form-control" name="department_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.department')]) ---" required>
                {{-- <option value="">@lang('inputs.please-select')</option> --}}
                @foreach ($departments as $id => $title)
                    <option value="{{ $id }}" @selected(isset($row) && $row->department_id == $id || old('department_id') == $id)>{{ $title }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'department_id'])
        </div>
        {{-- END DEPARTMENT --}}
    </div>

    <div class="col-md-4">
        {{-- START BEHALF --}}
        <div class="form-group">
            <label class="required">@lang('inputs.select-data', ['data' => trans('inputs.behalf')])</label>
            <select class="select2 form-control" name="behalf_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.behalf')]) ---" required>
                {{-- <option value="">@lang('inputs.please-select')</option> --}}
                @foreach ($users as $id => $name)
                    <option value="{{ $id }}" @selected(isset($row) && $row->behalf_id == $id || old('behalf_id') == $id)>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'behalf_id'])
        </div>
        {{-- END BEHALF --}}
    </div>

    <div class="col-md-4">
        {{-- START AGGREGATORS --}}
        <div class="form-group">
            <label class="required">@lang('inputs.select-data', ['data' => trans('menu.aggregator')])</label>
            <select class="select2 form-control" name="aggregator_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.aggregator')]) ---" required>
                {{-- <option value="">@lang('inputs.please-select')</option> --}}
                @foreach ($aggregators as $id => $title)
                    <option value="{{ $id }}" @selected(isset($row) && $row->aggregator_id == $id || old('aggregator_id') == $id)>{{ $title }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'aggregator_id'])
        </div>
        {{-- END AGGREGATORS --}}
    </div>

    <div class="col-md-12">
        {{-- START ROLES --}}
        <div class="form-group">
            <label>@lang('inputs.select-data', ['data' => trans('menu.roles')])</label>
            <select class="select2 form-control" id="roles" name="roles[]" multiple data-placeholder="--- @lang('inputs.select-data', ['data' => trans('menu.roles')]) ---">
                {{-- <option value="">@lang('inputs.please-select')</option> --}}
                @foreach ($roles as $id => $name)
                    <option value="{{ $id }}" @selected((isset($row) && $row->hasRole($name)) || (is_array(old('roles')) && in_array($id, old('roles'))))>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'roles'])
        </div>
        {{-- END ROLES --}}
    </div>
</div>

@push('script')
<script type="text/javascript" src="{{ assetHelper('customs/js/show-password.js') }}"></script>
@endpush
