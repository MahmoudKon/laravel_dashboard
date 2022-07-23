<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class ImageToolController extends Controller
{
    public function imageCrop()
    {
        return view('backend.image_tools.crop');
    }

    public function ChangeQuality()
    {
        return view('backend.image_tools.change-quality');
    }
}
