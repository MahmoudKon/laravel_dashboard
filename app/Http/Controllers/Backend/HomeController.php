<?php

namespace App\Http\Controllers\Backend;

use App\Events\NewEmail;
use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Email;
use App\Models\Route;
use App\Models\User;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    public function index()
    {
        // NewEmail::dispatch(Email::first());

        $count['users'] = User::count();
        $count['departments'] = Department::count();
        $count['roles'] = Role::count();
        $count['routes'] = Route::count();
        return view('backend.home.index', compact('count'));
    }
}
