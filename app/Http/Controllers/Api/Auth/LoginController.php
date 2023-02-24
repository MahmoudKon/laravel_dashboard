<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BasicApiController;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;

class LoginController extends BasicApiController
{
    public function login(LoginRequest $request): \Illuminate\Http\JsonResponse
    {
        $this->validateLogin($request);
        if (auth()->attempt($this->credentials($request))) {
            return $this->sendResponse('User login successfully.', $this->createToken());
        } else {
            return $this->sendError('These credentials do not match our records.');
        }
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|string',
            'password' => 'required|string',
        ]);
    }

    protected function credentials(Request $request): array
    {
        return [
            'email' => $request->email,
            'password' => $request->password
        ];
    }

    public function refresh(): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse('Token refreshed successfully.', $this->createToken());
    }

    public function authenticatedUserDetails(): \App\Http\Resources\UserResource
    {
        return new UserResource(auth()->user());
    }

    public function saveAuthMobileToken(): \Illuminate\Http\JsonResponse
    {
        if (! request()->mobile_token)
            return $this->sendError(errorMessages: ['errors' => 'Mobile token is requied!'], code: 422);

        auth()->user()->update(['mobile_token' => request('mobile_token')]);
        return $this->sendResponse('Mobile token saved successfully.');
    }

    protected function createToken(): array
    {
        $this->deleteCurrentToken();
        return [
            'token_type' => 'Bearer',
            'token'      => auth()->user()->createToken(env('API_HASH_TOKEN', 'ClubApp'))->accessToken,
            'user'       => new UserResource(auth()->user()),
        ];
    }

    protected function deleteCurrentToken(): void
    {
        $token = auth()->user()->token();
        if ($token) $token->delete();
    }
}
