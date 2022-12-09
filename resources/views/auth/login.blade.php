@extends('layouts.auth')

@section('page_title', 'Login')
@section('title', 'Welcome to ' . setting('site_name'))

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf

    <!-- BEGIN USER NAME INPUT -->
    <fieldset class="form-group">
        <label for="email" class="required">Email or Code</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa-solid fa-envelope"></i> </span>
                <span class="input-group-text"> <i class="fa-solid fa-barcode"></i> </span>
            </div>
            <input type="text" id="username" name="username" class="form-control" value="{{ old('username') ?? env('LOGIN_EMAIL', '') }}"
                    autofocus placeholder="Type your email or phone..." required>
        </div>
        @foreach ($errors->getMessages() as $input_name => $values)
            <x-validation-error input='{{ $input_name }}' />
        @endforeach
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
            <input type="password" id="password" name="password" value="{{ old('password') ?? env('LOGIN_PASSWORD', '') }}"
                autocomplete="current-password" placeholder="Type your password..." class="form-control" required>
        </div>
        <x-validation-error input='password' />
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

    <p class="text-left m-0">
        <a href="{{ route('auth.provider', 'github') }}" class="btn btn-sm btn-github login-provider"> <i class="fa-brands fa-github"></i> Github</a>
        <a href="{{ route('auth.provider', 'google') }}" class="btn btn-sm btn-google login-provider"> <i class="fa-brands fa-google"></i> Google</a>
        <a href="{{ route('auth.provider', 'gitlab') }}" class="btn btn-sm btn-warning login-provider"> <i class="fa-brands fa-gitlab"></i> Gitlab</a>
        <a href="{{ route('auth.provider', 'facebook') }}" class="btn btn-sm btn-facebook login-provider"> <i class="fa-brands fa-facebook"></i> Facebook</a>
    </p>
    <p class="text-right m-0"> New to {{ env('APP_NAME') }} ? <a href="{{ route('register') }}" class="card-link text-bold-500">Sign Up</a> </p>
</div>
@endsection


@section('script')
    <script>
        $(function() {
            $('.login-provider').on('click', function() {
                $(this).closest('.card').addClass('load');
            })
        });
    </script>
@endsection
