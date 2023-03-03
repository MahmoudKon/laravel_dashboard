<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\User;
use App\Traits\UploadFile;

class ProfileController extends Controller
{
    use UploadFile;

    public function index()
    {
        $user = auth()->user();
        return view('backend.profile.index', compact('user'));
    }

    public function info(ProfileRequest $request)
    {
        auth()->user()->update($request->validated());
        toast(trans('flash.change info'), 'success');
        return response()->json(['reload' => true]);
    }

    public function avatar(ProfileRequest $request)
    {
        $this->remove(auth()->user()->image);
        auth()->user()->update(['image' => $this->uploadImage($request->image, 'users')]);
        toast(trans('flash.change image'), 'success');
        return response()->json(['reload' => true]);
    }

    public function password(ProfileRequest $request)
    {
        auth()->user()->update(['password' => $request->new_password]);
        return response()->json(['message' => trans('flash.change password'), 'icon' => 'success']);
    }
}
