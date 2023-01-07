<?php

namespace App\Http\Services;

use Exception;
use App\Models\SocialMedia;

class SocialMediaService
{
    public function handle($request, $id = null)
    {
        try {
            return SocialMedia::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
