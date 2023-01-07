<div class='row'>
    <div class="col-md-7">
        {{-- START email --}}
        <div class="form-group">
            <label class="required">@lang('inputs.email')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                </div>
                <input type="text" class="form-control" name="email" required value="{{ $row->email ?? old('email') }}"  placeholder="@lang('inputs.email')">
            </div>
            <x-validation-error input='email' />
        </div>
        {{-- END email --}}

        {{-- START username --}}
        <div class="form-group">
            <label class="required">@lang('inputs.username')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-user-secret"></i> </span>
                </div>
                <input type="text" class="form-control" name="username" required value="{{ $row->username ?? old('username') }}"  placeholder="@lang('inputs.username')">
            </div>
            <x-validation-error input='username' />
        </div>
        {{-- END username --}}

        {{-- START phone --}}
        <div class="form-group">
            <label class="required">@lang('inputs.phone')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"> <i class="fa-solid fa-phone-volume"></i> </span>
                </div>
                <input type="text" class="form-control" name="phone"  value="{{ $row->phone ?? old('phone') }}"  placeholder="@lang('inputs.phone')">
            </div>
            <x-validation-error input='phone' />
        </div>
        {{-- END phone --}}

        {{-- START PASSWORD --}}
        <div class="form-group">
            <label class="{{ isset($row) ? '' : 'required' }}">@lang('inputs.password')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text show-password"> <i class="fas fa-lock"></i> </span>
                </div>
                <input type="password" class="form-control" name="password" placeholder=" @lang('inputs.password')" {{ isset($row) ? '' : 'required' }}>
            </div>
            <x-validation-error input='password' />
        </div>
        {{-- END PASSWORD --}}
    </div>

    <div class="col-md-5">
        @include('backend.includes.forms.input-file', ['image' => isset($row) && $row->image ? url($row->image) : null, 'alt' => $row->name ?? null])
    </div>
</div>


@once
    @push('script')
        <script type="text/javascript" src="{{ assetHelper('customs/js/show-password.js') }}"></script>
    @endpush
@endonce
