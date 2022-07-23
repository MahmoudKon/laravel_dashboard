<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BasicApiController;

class LogoutController extends BasicApiController
{
        /**
     * logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return $this->sendResponse("Logged Out successfully");
    }
}
