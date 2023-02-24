<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BasicApiController;

class LogoutController extends BasicApiController
{
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->user()->token()->delete();
        return $this->sendResponse("Logged Out successfully");
    }
}
