<div class="row">
    {{-- START EMAIL --}}
    <div class="col-md-8">
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

    {{-- START CODE --}}
    <div class="col-md-4">
        <div class="form-group">
            <label>@lang('inputs.code')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-barcode"></i> </span>
                </div>
                <input type="text" disabled readonly class="form-control" value="{{ auth()->user()->code }}">
            </div>
        </div>
    </div>
    {{-- END CODE --}}

    {{-- START DEPARTMENT --}}
    <div class="col-md-6">
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

    {{-- START USERNAME --}}
    <div class="col-md-6">
        <div class="form-group">
            <label class="required">@lang('inputs.name')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fas fa-user"></i> </span>
                </div>
                <input type="text" name="name" class="form-control" value="{{ auth()->user()->name }}">
            </div>
            <x-validation-error input='name' />
        </div>
    </div>
    {{-- END USERNAME --}}
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
