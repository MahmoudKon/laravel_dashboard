<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function soon()
    {
        return view('pages.coming-soon');
    }

    public function maintenance()
    {
        return view('pages.under-maintenance');
    }
}
