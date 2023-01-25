@extends('layouts.auth')

@section('page_title', 'Verify Email')
@section('title', 'Verify Your Email Address with ' . getSettingKey('site_name', env('APP_NAME')))

@section('content')
    @if (session('resent'))
        <div class="alert alert-success" role="alert">
            {{ __('A fresh verification link has been sent to your email address.') }}
        </div>
    @endif

    <p>Before proceeding, please check your email for a verification link</p>
    <p>If you did not receive the email</p>

    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
        @csrf
        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('click here to request another') }}</button>.
    </form>
@endsection

