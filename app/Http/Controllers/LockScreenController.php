<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LockScreenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function lock()
    {
        if (stripos(url()->previous(), 'login') !== false) return redirect(ROUTE_PREFIX.'/');
        session(['locked' => 'true', 'unlook-redirect' => self::previousRoute()]);
        return view('auth.lock');
    }

    public function unlock(Request $request)
    {
        $this->validate($request, ['password' => 'required|string']);

        if(Hash::check(request()->password, auth()->user()->password)){
            toast('Welcome Back '.auth()->user()->name, 'success');
            return redirect()->route(self::redirect());
        }

        return back()->with('failed', 'Password does not match. Please try again.');
    }

    protected function previousRoute()
    {
        if (session('unlook-redirect') && stripos(session('unlook-redirect'), 'lockscreen') === false)
            return session('unlook-redirect');
        $previous_url = str_replace(session('locale').'/', '', url()->previous());

        return \Illuminate\Support\Facades\Route::getRoutes()->match(request()->create($previous_url))->getName();
    }

    protected function redirect()
    {
        $redirect = session('unlook-redirect');
        session()->forget(['unlook-redirect', 'locked']);
        return $redirect == 'lock' ? ROUTE_PREFIX.'/' : $redirect;
    }
}
