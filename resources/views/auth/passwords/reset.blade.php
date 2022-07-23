@extends('layouts.auth')

@section('page_title', 'Reset Password')
@section('title', 'Reset Password with ' . config('app.name'))

@section('content')
<form method="POST" action="{{ route('password.update') }}">
    @csrf

    <input type="hidden" name="token" value="{{ $token }}">

    <!-- BEGIN USER NAME INPUT -->
    <fieldset class="form-group">
        <label for="email" class="required">Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"> <i class="fa fa-envelope"></i></span>
            </div>
            <input type="email" id="email" name="email" class="form-control" value="{{ $email ?? old('email') }}"
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
            <input type="password" id="password" name="password" value="{{ old('password') }}"
                autocomplete="current-password" placeholder="Type your password..." class="form-control" required>
        </div>
        @include('layouts.includes.backend.validation_error', ['input' => 'password'])
    </fieldset>
    <!-- END USER PASSWORD INPUT -->

    <!-- BEGIN USER PASSWORD INPUT -->
    <fieldset class="form-group">
        <label for="password" class="required">Confirm Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text show-password" data-toggle="tooltip" data-original-title="Show Password">
                    <i class="fas fa-eye-slash"></i>
                </span>
            </div>
            <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}"
                autocomplete="new_confirmation" placeholder="Type your password confirmation..." class="form-control" required>
        </div>
        @include('layouts.includes.backend.validation_error', ['input' => 'password_confirmation'])
    </fieldset>
    <!-- END USER PASSWORD INPUT -->

    <button type="submit" class="btn btn-info btn-lg btn-block"><i class="fa fa-unlock-alt"></i> Reset Password</button>
</form>
<p class="text-center"> Go To<a href="{{ route('login') }}" class="card-link">Login ?</a> </p>
@endsection



