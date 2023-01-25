@extends('layouts.auth')

@section('page_title', 'Reset Password')
@section('title', 'Reset Password with ' . getSettingKey('site_name', env('APP_NAME')))

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <!-- BEGIN USER NAME INPUT -->
    <fieldset class="form-group">
        <label for="email" class="required">@lang('inputs.email')</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa-solid fa-envelope"></i> </span>
            </div>
            <input type="email" id="email" name="email" class="form-control" value="{{ $email ?? old('email') }}"
                    autofocus placeholder="Type your email..." autocomplete="email" required>
        </div>
        <x-validation-error input='email' />
    </fieldset>
    <!-- END USER NAME INPUT -->

    <!-- BEGIN USER PASSWORD INPUT -->
    <fieldset class="form-group">
        <label for="password" class="required">@lang('inputs.password')</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text show-password" data-toggle="tooltip" data-original-title="Show Password">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password" name="password" value="{{ old('password') }}"
                autocomplete="current-password" placeholder="Type your password..." class="form-control" required>
        </div>
        <x-validation-error input='password' />
    </fieldset>
    <!-- END USER PASSWORD INPUT -->

    <!-- BEGIN USER PASSWORD INPUT -->
    <fieldset class="form-group">
        <label for="password" class="required">@lang('inputs.password_confirmation')</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text show-password" data-toggle="tooltip" data-original-title="Show Password">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                autocomplete="new_confirmation" placeholder="Type your password confirmation..." class="form-control" required>
        </div>
        <x-validation-error input='password_confirmation' />
    </fieldset>
    <!-- END USER PASSWORD INPUT -->

    <button type="submit" class="btn btn-info btn-lg btn-block"><i class="fa fa-unlock-alt"></i> Reset Password</button>
</form>

<div class="card-footer d-lg-flex justify-content-between">
    <p class="text-right m-0"> Go To <a href="{{ route('login') }}" class="card-link text-bold-500">Login</a>? </p>
</div>

@endsection



