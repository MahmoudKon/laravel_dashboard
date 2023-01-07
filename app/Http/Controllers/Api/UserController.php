<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiController;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Http\Services\UserService;
use App\Models\User;

class UserController extends ApiController
{
    public function __construct()
    {
        parent::__construct(UserResource::class, User::class);
    }

    public function getQuery() :object
    {
        return $this->model::hasManager()->exceptAuth()->filter();
    }

    public function store(UserRequest $request, UserService $userService)
    {
        $user = $userService->handle($request->validated());
        if (is_string($user)) return $this->sendError($user);
        return $this->sendResponse(trans('flash.row created', ['model' => trans('menu.user')]), [ 'user' => new UserResource($user) ]);
    }

    public function update(UserRequest $request, UserService $userService, $id)
    {
        $user = $userService->handle($request->validated(), $id);
        if (is_string($user)) return $this->sendError($user);
        return $this->sendResponse(trans('flash.row updated', ['model' => trans('menu.user')]), [ 'user' => new UserResource($user) ]);
    }
}
