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
            <x-validation-error input='name' />
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
            <x-validation-error input='email' />
        </div>
        {{-- END  EMAIL --}}

    </div>

    <div class="col-md-3">
        {{-- START USER IMAGE --}}
        @include('backend.includes.forms.input-file', ['image' => isset($row) && $row->image ? url($row->image) : null, 'alt' => $row->name ?? null])
        {{-- START USER IMAGE --}}
    </div>

</div>

<div class="row">
    <div class="col-md-6">
        {{-- START PASSWORD --}}
        <div class="form-group">
            <label class="{{ isset($row) ? '' : 'required' }}">@lang('inputs.password')</label>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text show-password"> <i class="fas fa-eye-slash"></i> </span>
                </div>
                <input type="password" class="form-control" name="password" placeholder=" @lang('inputs.password')" {{ isset($row) ? '' : 'required' }}>
            </div>
            <x-validation-error input='password' />
        </div>
        {{-- END PASSWORD --}}
    </div>

    <div class="col-md-6">
        {{-- START DEPARTMENT --}}
        <x-html.select name='department_id' :list="$departments"
                        :selected="old('department_id', ($row->department_id ?? null))" required="required"
                        :label="trans('inputs.select-data', ['data' => trans('menu.department')])" />
        {{-- END DEPARTMENT --}}
    </div>
</div>

{{-- START ROLES --}}
<div class="form-group">
    <x-html.select name='roles[]' :list="$roles"
                :selected="old('roles[]', (isset($row) ? $row->roles()->pluck('id')->toArray() : []))"
                :label="trans('inputs.select-data', ['data' => trans('menu.roles')])" multiple />
</div>
{{-- END ROLES --}}

@push('script')
<script type="text/javascript" src="{{ assetHelper('customs/js/show-password.js') }}"></script>
@endpush
