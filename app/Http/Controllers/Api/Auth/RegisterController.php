<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BasicApiController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\Role;
use App\Models\User;

class RegisterController extends BasicApiController
{
    public function register(UserRequest $request)
    {
        return $this->sendResponse(trans('flash.row created', ['model' => trans('menu.user')]), $this->createToken($request));
    }

    protected function createToken($request)
    {
        $user = $this->createUser($request);
        return [
            'token' => "Bearer ".$user->createToken(env('API_HASH_TOKEN', 'ClubApp'))->accessToken,
            'message' => trans('permissions.account not acctive'),
            'user'  => new UserResource($user),
        ];
    }

    protected function createUser($request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'department_id' => $request->department_id,
        ]);

        $user->syncRoles(Role::first()->id);
        return $user;
    }
}
