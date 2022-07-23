<div class="row">
    {{-- START EMAIL --}}
    <div class="col-md-7">
        <div class="form-group">
            <label>@lang('inputs.email')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-envelope"></i> </span>
                </div>
                <input type="text" disabled readonly class="form-control" value="{{ auth()->user()->email }}">
            </div>
        </div>
    </div>
    {{-- END EMAIL --}}

    {{-- START USERNAME --}}
    <div class="col-md-5">
        <div class="form-group">
            <label class="required">@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                </div>
                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
            </div>
            @include('layouts.includes.backend.validation_error', ['input' => 'name'])
        </div>
    </div>
    {{-- END USERNAME --}}

    {{-- START BEHALF --}}
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('inputs.select-data', ['data' => trans('inputs.behalf')])</label>

            <select class="select2 form-control" id="behalf_id" name="behalf_id" data-placeholder="--- @lang('inputs.select-data', ['data' => trans('inputs.behalf')]) ---">
                <option value=" ">--- @lang('inputs.select-data', ['data' => trans('inputs.behalf')]) ---</option>
                @foreach ($behalfs as $id => $name)
                    <option value="{{ $id }}" @selected($user->behalf_id == $id)>{{ $name }}</option>
                @endforeach
            </select>
            @include('layouts.includes.backend.validation_error', ['input' => 'behalf_id'])
        </div>
    </div>
    {{-- END BEHALF --}}

    {{-- START DEPARTMENT --}}
    <div class="col-md-3">
        <div class="form-group">
            <label>@lang('menu.department')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-building-user"></i> </span>
                </div>
                <input type="text" disabled readonly class="form-control" value="{{ auth()->user()->department->title ?? '' }}">
            </div>
        </div>
    </div>
    {{-- END DEPARTMENT --}}

    {{-- START AGGREGATOR --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('menu.aggregator')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-certificate"></i> </span>
                </div>
                <input type="text" disabled readonly class="form-control" value="{{ auth()->user()->aggregator->title ?? '' }}">
            </div>
        </div>
    </div>
    {{-- END AGGREGATOR --}}

    {{-- START ANNUAL CREDIT --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('inputs.annual-credit')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-certificate"></i> </span>
                </div>
                <input type="text" disabled readonly class="form-control" value="{{ auth()->user()->annual_credit }}">
            </div>
        </div>
    </div>
    {{-- END ANNUAL CREDIT --}}

    {{-- START FINGER PRINT ID --}}
    <div class="col-md-2">
        <div class="form-group">
            <label>@lang('inputs.finger-print-id')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-fingerprint"></i> </span>
                </div>
                <input type="text" disabled readonly class="form-control" value="{{ auth()->user()->finger_print_id }}">
            </div>
        </div>
    </div>
    {{-- END FINGER PRINT ID --}}
</div>

{{-- START ROLES --}}
<div class="form-group">
    <label>@lang('menu.roles')</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <span class="input-group-text"> <i class="fas fa-shield"></i> </span>
        </div>
        <input type="text" disabled readonly class="form-control" value="{{ implode(' | ', auth()->user()->roles()->pluck('name')->toArray()) }}">
    </div>
</div>
{{-- END ROLES --}}
