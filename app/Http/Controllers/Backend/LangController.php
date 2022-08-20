<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LangController extends Controller
{
    public function index()
    {
        $file = config_path('laravellocalization.php');
        $content = file_get_contents($file);
        dd( explode("\n", $content) , token_get_all( $file ));
    }
}
