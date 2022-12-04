<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginServiceController extends Controller
{
    public function serviceRedirect($service)
    {
        return Socialite::driver($service)->redirect();
    }


    public function serviceCallback()
    {
        try {
            $service = $this->getService();
            $user = Socialite::driver($service)->user();

            $searchUser = User::firstOrCreate(['email' => $user->email], [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $service,
                'image' => $user->avatar,
                'email_verified_at' => now(),
                'remember_token' => now(),
            ]);

            Auth::login($searchUser);

            return redirect()->route(ROUTE_PREFIX.'/');
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }

    protected function getService()
    {
        $prev_url = request()->session()->previousUrl();
        return last( explode('/', $prev_url) );
    }
}
