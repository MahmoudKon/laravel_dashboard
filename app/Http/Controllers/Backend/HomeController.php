<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\LockScreenMiddleware;
use App\Models\Announcement;
use App\Models\Department;
use App\Models\Language;
use App\Models\Menu;
use App\Models\OauthSocial;
use App\Models\Route;
use App\Models\Setting;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware([LockScreenMiddleware::class]);
    }

    public function index()
    {
        if (auth()->user()->roles()->count() == 0 && ! isSuperAdmin())
            return redirect('/');

        $tables['users']         = ['count' => User::count()      , 'color' => 'info'];
        $tables['departments']   = ['count' => Department::count(), 'color' => 'primary'];
        $tables['roles']         = ['count' => Role::count()      , 'color' => 'warning'];
        $tables['routes']        = ['count' => Route::count()     , 'color' => 'success'];
        $tables['settings']      = ['count' => Setting::count()   , 'color' => 'primary'];
        $tables['languages']     = ['count' => Language::active()->count()  , 'color' => 'dark'];
        $tables['announcements'] = ['count' => Announcement::count() , 'color' => 'google'];
        $tables['oauth_socials'] = ['count' => OauthSocial::active()->count() , 'color' => 'google'];
        $icons = Menu::select('icon', 'name->en as name')->pluck('icon', 'name')->toArray();
        $active_announcements = Announcement::Display()->inRandomOrder()->limit(5)->get();
        return view('backend.home.index', compact('tables', 'icons', 'active_announcements'));
    }
}
