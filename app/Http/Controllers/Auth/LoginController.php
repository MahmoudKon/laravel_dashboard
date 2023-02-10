<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        $field = "email";
        if (filter_var(request()->username, FILTER_VALIDATE_INT)) $field = "code";
        else if (filter_var(request()->username, FILTER_VALIDATE_EMAIL)) $field = "email";
        else if ( is_string( request()->username ) ) $field = "name";

        request()->merge([$field => request()->username]);
        return $field;
    }

    protected function authenticated(Request $request, $user)
    {
        $user->update(['logged_in' => true]);
    }

    public function redirectPath()
    {
        return routeHelper('/');
    }

    public function logout() {
        Cache::forget('user-is-online-'.auth()->id());
        session()->flush();
        auth()->logout();
        return redirect('/login');
    }
}
