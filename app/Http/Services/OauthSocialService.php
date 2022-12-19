<?php

namespace App\Http\Services;

use Exception;
use App\Models\OauthSocial;

class OauthSocialService
{
    public function handle($request, $id = null)
    {
        try {
            $row = OauthSocial::updateOrCreate(['id' => $id], $request);
            return $row;
        } catch (Exception $e) {
            return $e;
        }
    }
}
