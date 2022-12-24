<?php

namespace App\Http\Services;

use Exception;
use App\Models\OauthSocial;

class OauthSocialService
{
    public function handle($request, $id = null)
    {
        try {
            return OauthSocial::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
