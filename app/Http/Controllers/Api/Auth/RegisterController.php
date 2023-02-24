<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BasicApiController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;

class RegisterController extends BasicApiController
{
    public function register(UserRequest $request): \Illuminate\Http\JsonResponse
    {
        return $this->sendResponse(trans('flash.row created', ['model' => trans('menu.user')]), $this->createToken($request->validated()));
    }

    protected function createToken(array $data): array
    {
        $user = $this->createUser($data);
        return [
            'token_type' => 'Bearer',
            'token'      => $user->createToken(env('API_HASH_TOKEN', env('APP_NAME')))->accessToken,
            'message'    => trans('permissions.account not acctive'),
            'user'       => new UserResource($user),
        ];
    }

    protected function createUser(array $data): \App\Models\User
    {
        $user = User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'password'      => $data['password'],
            'department_id' => $data['department_id'],
        ]);

        $user->syncRoles(Role::first()->id);
        return $user;
    }
}
