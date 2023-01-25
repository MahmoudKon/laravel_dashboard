@extends('layouts.auth')

@section('page_title', 'Register')
@section('title', 'Register with ' . getSettingKey('site_name', env('APP_NAME')))

@section('content')
<form action="{{ route('register') }}" method="POST">
    @csrf

    <!-- BEGIN USER NAME INPUT -->
    <fieldset class="form-group">
        <label for="name" class="required">Username</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-user"></i></span>
            </div>
            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                    autofocus placeholder="Type your name..." autocomplete="name" required>
        </div>
        <x-validation-error input='name' />
    </fieldset>
    <!-- END USER NAME INPUT -->

    <!-- BEGIN USER EMAIL INPUT -->
    <fieldset class="form-group">
        <label for="email" class="required">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa-solid fa-envelope"></i> </span>
            </div>
            <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}"
                    autofocus placeholder="Type your email..." autocomplete="email" required>
        </div>
        <x-validation-error input='email' />
    </fieldset>
    <!-- END USER EMAIL INPUT -->

    <!-- BEGIN USER PASSWORD INPUT -->
    <fieldset class="form-group">
        <label for="password" class="required">Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text show-password" data-toggle="tooltip" data-original-title="Show Password">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password" name="password" value="{{ old('password') }}"
                autocomplete="new-password" placeholder="Type your password..." class="form-control" required>
        </div>
        <x-validation-error input='password' />
    </fieldset>
    <!-- END USER PASSWORD INPUT -->

    <!-- BEGIN USER PASSWORD CONFIRMATION INPUT -->
    <fieldset class="form-group">
        <label for="password_confirmation" class="required">Confirm Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text show-password" data-toggle="tooltip" data-original-title="Show Password">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                autocomplete="new-password" placeholder="Password Confirmation..." class="form-control" required>
        </div>
        <x-validation-error input='password' />
    </fieldset>
    <!-- END USER PASSWORD CONFIRMATION INPUT -->

    <button type="submit" class="btn btn-info btn-lg btn-block"><i class="fa fa-unlock-alt"></i> Register</button>
</form>

<div class="card-footer d-lg-flex justify-content-between">
    <p class="text-left m-0">
        @foreach (\App\Models\OauthSocial::active()->get() as $social)
            {!! $social->getTemplate(true) !!}
        @endforeach
    </p>

    <p class="text-center m-0">Already have an account ? <a href="{{ route('login') }}" class="card-link text-bold-500">Login</a></p>
</div>
@endsection
