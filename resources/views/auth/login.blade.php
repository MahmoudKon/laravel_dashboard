@extends('layouts.auth')

@section('page_title', 'Login')
@section('title', 'Welcome to ' . setting('site_name'))

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf

    <!-- BEGIN USER NAME INPUT -->
    <fieldset class="form-group">
        <label for="email" class="required">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i></span>
            </div>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') ?? 'super_admin@ivas.com' }}"
                    autofocus placeholder="Type your email..." autocomplete="email" required>
        </div>
        @include('layouts.includes.backend.validation_error', ['input' => 'email'])
    </fieldset>
    <!-- END USER NAME INPUT -->

    <!-- BEGIN USER PASSWORD INPUT -->
    <fieldset class="form-group">
        <label for="password" class="required">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text show-password" data-toggle="tooltip" data-original-title="Show Password">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password" name="password" value="{{ old('password') ?? '123' }}"
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
                <label for="remember-me" class="px-1" data-toggle="tooltip" data-original-title="The system will remember your login"> Remember Me</label>
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

    <button type="submit" class="btn btn-info btn-lg btn-block"><i class="fa fa-unlock-alt"></i> Login</button>
</form>

<div class="card-footer d-lg-flex justify-content-between">
    {{-- <p class="text-left m-0"><a href="{{ route('password.request') }}" class="card-link text-bold-500">Recover password</a></p> --}}
    <p class="text-right m-0"> New to {{ env('APP_NAME') }} ? <a href="{{ route('register') }}" class="card-link text-bold-500">Sign Up</a> </p>
</div>
@endsection
