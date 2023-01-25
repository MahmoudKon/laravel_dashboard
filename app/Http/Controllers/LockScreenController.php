<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;

class LockScreenController extends Controller
{
    public function lock()
    {
        if (!auth()->check()) return redirect('login');
        if (stripos(url()->previous(), 'login') !== false) return redirect('/');
        session(['locked' => 'true', 'unlook-redirect' => $this->previousRoute()]);
        return view('auth.lock');
    }

    public function unlock(Request $request)
    {
        $this->validate($request, ['password' => 'required|string']);
        auth()->logout();

        $cerdintial = ['email' => decrypt($request->email), 'password' => $request->password ];
        if (auth()->attempt($cerdintial)) {
            toast('Welcome Back '.auth()->user()->name, 'success');
            return redirect()->route($this->redirect());
        }

        return back()->with('failed', 'Password does not match. Please try again.');
    }

    protected function previousRoute()
    {
        if (session('unlook-redirect') && stripos(session('unlook-redirect'), 'lockscreen') === false)
            return session('unlook-redirect');
        $previous_url = str_replace('/'.session('locale').'/', '/', url()->previous());

        try {
            return \Illuminate\Support\Facades\Route::getRoutes()->match(request()->create($previous_url))->getName();
        } catch (Exception $e) { return '/'; }

    }

    protected function redirect()
    {
        $redirect = session('unlook-redirect');
        session()->forget(['unlook-redirect', 'locked']);
        return $redirect == 'lock' ? getRoutePrefex().'/' : $redirect;
    }
}
