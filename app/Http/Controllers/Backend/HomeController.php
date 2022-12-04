<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Menu;
use App\Models\Route;
use App\Models\Setting;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index()
    {
        // if (auth()->user()->permissions()->count() == 0 && ! isSuperAdmin())
        //     return redirect('/');

        $tables['users']         = ['count' => User::count()      , 'color' => 'info'];
        $tables['departments']   = ['count' => Department::count(), 'color' => 'primary'];
        $tables['roles']         = ['count' => Role::count()      , 'color' => 'warning'];
        $tables['routes']        = ['count' => Route::count()     , 'color' => 'success'];
        $tables['settings']      = ['count' => Setting::count()   , 'color' => 'primary'];
        $icons = Menu::select('icon', 'name->en as name')->pluck('icon', 'name')->toArray();
        return view('backend.home.index', compact('tables', 'icons'));
    }
}
