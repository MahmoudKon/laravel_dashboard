<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\BasicApiController;
use App\Models\PasswordPinCode;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

class ForgotPasswordController extends BasicApiController
{
    const SEND_MAIL = 1;
    const RESET_PASSWORD = 0;
    const PINCODE_LENGTH = 6;
    public static $action = self::SEND_MAIL;

    public function sendResetLinkEmail(Request $request): \Illuminate\Http\JsonResponse
    {
        if ($this->validateData($request)->fails()) return $this->sendError(trans('passwords.user'));

        $this->createPinCode($request);

        return $this->sendResponse(trans('passwords.sent pincode'));
    }

    protected function createPinCode(Request $request): void
    {
        $pincode = Str::upper(Str::random(self::PINCODE_LENGTH));

        PasswordPinCode::create(['email' => $request->email, 'pincode'  => $pincode]);
    }

    public function changePassword(Request $request): \Illuminate\Http\JsonResponse
    {
        self::$action = self::RESET_PASSWORD;

        $validation = $this->validateData($request);

        if($validation->fails())
            return $this->sendError(trans('flash.invalid data'), $validation->errors());

        if (! $this->checkPinCode($request))
            return $this->sendError(trans('passwords.token'));

        return $this->updatePassword($request);
    }

    protected function validateData(Request $request): \Illuminate\Contracts\Validation\Validator
    {
        $validation = ['email' => 'required|email|exists:users,email'];

        if (self::$action !== self::SEND_MAIL) {
            $validation = array_merge($validation, [
                'pincode'  => 'required|string|size:'.self::PINCODE_LENGTH,
                'password' => [Password::default()->min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
            ]);
        }

        return Validator::make($request->all(), $validation);
    }

    protected function checkPinCode(Request $request) :bool
    {
        $row = PasswordPinCode::where(['email' => $request->email, 'pincode'  => $request->pincode])->NotExpired()->first();

        if (!$row) return false;

        return $row->update(['expired' => true]);
    }

    protected function updatePassword(Request $request): \Illuminate\Http\JsonResponse
    {
        $user = User::where('email', $request->email)->first();

        $user->update(['password' => $request->password]);

        return $this->sendResponse(trans('passwords.reset'));
    }
}
