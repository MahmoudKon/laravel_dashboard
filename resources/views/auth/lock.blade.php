@extends('layouts.auth')

@section('page_title', 'Lock Screen')
@section('title', trans('title.unlock account'))

@section('content')

@include('layouts.includes.backend.alerts')

<form action="{{ route('unlock') }}" method="POST">
    @csrf
    <input type="hidden" name="email" value="{{ encrypt(auth()->user()->email) ?? old('email') }}" required>

    <!-- BEGIN USER PASSWORD INPUT -->
    <fieldset class="form-group">
        <label for="password" class="required">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text show-password" data-toggle="tooltip" data-original-title="Show Password">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password" name="password" value="{{ old('password') ?? env('LOGIN_PASSWORD', '') }}"
                autocomplete="current-password" placeholder="Type your password..." class="form-control" required>
        </div>
        @include('layouts.includes.backend.validation_error', ['input' => 'password'])
    </fieldset>
    <!-- END USER PASSWORD INPUT -->

    <!-- BEGIN OPTIONS INPUT -->
    <div class="form-group row">
        <div class="col-md-6 col-12 text-center text-md-left">
            <fieldset>
                <input type="checkbox" id="remember-me" class="chk-remember" name="remember" @checked(old('remember'))>
                <label for="remember-me" class="px-1 cursor-pointer" data-toggle="tooltip" data-original-title="The system will remember your login"> Remember Me</label>
            </fieldset>
        </div>
        @if (Route::has('password.request'))
        <div class="col-md-6 col-12 text-center text-md-right">
            <a href="{{ route('password.request') }}" class="card-link text-bold-500" data-toggle="tooltip" data-original-title="Forget and reset password">
                Forgot Your Password ?
            </a>
        </div>
        @endif
    </div>
    <!-- END OPTIONS INPUT -->

    <button type="submit" class="btn btn-outline-info btn-block" data-toggle="tooltip" data-original-title="@lang('title.unlock account')"><i class="fa fa-unlock-alt"></i> @lang('buttons.unlock')</button>
</form>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="mt-1">
    @csrf
    <button type="submit" class="btn btn-outline-danger d-block w-100" data-toggle="tooltip" data-original-title="@lang('menu.logout')">
        <i class="ft-power"></i> @lang('menu.logout')
    </button>
</form>
@endsection
