<div class="row">
    {{-- START PASSWORD --}}
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">@lang('inputs.password')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text show-password"> <i class="fas fa-lock"></i> </span>
                </div>
                <input type="password" class="form-control" name="password" placeholder=" @lang('inputs.password')" >
            </div>
            <x-validation-error input='password' />
        </div>
    </div>
    {{-- END PASSWORD --}}

    {{-- START NEW PASSWORD --}}
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">@lang('inputs.new_password')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text show-password"> <i class="fas fa-lock"></i> </span>
                </div>
                <input type="password" class="form-control" name="new_password" placeholder=" @lang('inputs.new_password')" >
            </div>
            <x-validation-error input='new_password' />
        </div>
    </div>
    {{-- END NEW PASSWORD --}}

    {{-- START PASSWORD CONFIRMATION --}}
    <div class="col-md-4">
        <div class="form-group">
            <label class="required">@lang('inputs.password_confirmation')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text show-password"> <i class="fas fa-lock"></i> </span>
                </div>
                <input type="password" class="form-control" name="password_confirmation" placeholder=" @lang('inputs.password_confirmation')" >
            </div>
            <x-validation-error input='password_confirmation' />
        </div>
    </div>
    {{-- END PASSWORD CONFIRMATION --}}
</div>
