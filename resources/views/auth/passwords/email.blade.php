@extends('layouts.auth')

@section('page_title', 'Reset Password')
@section('title', 'We will send you a link to reset password')

@section('content')
<form method="POST" action="{{ route('password.email') }}">
    @csrf

    <!-- BEGIN USER NAME INPUT -->
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
    <!-- END USER NAME INPUT -->

    <button type="submit" class="btn btn-info btn-lg btn-block" data-toggle="tooltip" data-original-title="Send to me email">
        <i class="fa fa-unlock-alt"></i> Send Password Reset Link
    </button>
</form>

<div class="card-footer">
    <p class="m-0">Back to <a href="{{ url('login') }}" class="card-link">Login</a> ?</p>
</div>
@endsection
