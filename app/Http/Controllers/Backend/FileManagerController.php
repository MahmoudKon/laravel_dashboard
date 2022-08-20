<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FileManagerController extends Controller
{
    public function index()
    {
        $dir    = asset('packages/barryvdh/elfinder');
        $locale = config('app.locale');
        return view('backend.elFinder.index', compact('dir', 'locale'));
    }
}
