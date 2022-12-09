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
                    <i class="fa-solid fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password" name="password" value="{{ old('password') ?? env('LOGIN_PASSWORD', '') }}"
                autocomplete="current-password" placeholder="Type your password..." class="form-control" required>
        </div>
        <x-validation-error input='password' />
    </fieldset>
    <!-- END USER PASSWORD INPUT -->

    <button type="submit" class="btn btn-outline-info btn-block" data-toggle="tooltip" data-original-title="@lang('title.unlock account')">
        <i class="fa-sharp fa-solid fa-unlock"></i> @lang('buttons.unlock')
    </button>
</form>


<!-- BEGIN OPTIONS INPUT -->
<div class="form-group mt-2 row">
    <div class="col-md-6 col-12 text-center text-md-left">
        <fieldset>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger d-block w-100" data-toggle="tooltip" data-original-title="@lang('menu.logout')">
                    <i class="fa-solid fa-power-off"></i> @lang('menu.logout')
                </button>
            </form>
        </fieldset>
    </div>
    @if (Route::has('password.request'))
    <div class="col-md-6 col-12 text-center text-md-right">
        <a href="{{ route('password.request') }}" class="btn btn-primary d-block w-100" data-toggle="tooltip" data-original-title="Forget and reset password">
            <i class="fa-solid fa-key"></i> Forgot Your Password ?
        </a>
    </div>
    @endif
</div>
<!-- END OPTIONS INPUT -->
@endsection
