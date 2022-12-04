<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $pass_validation = request()->route('user') ? "nullable" : "required";
        return [
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,'.request()->route('user'),
            'password'      => [$pass_validation, Password::defaults()->min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
            'image'         => 'nullable',
            'department_id' => 'required|exists:departments,id',
            'roles'         => 'nullable|array',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => trans('inputs.model name', ['model' => trans('menu.user')]),
            'email'         => trans('inputs.email'),
            'password'      => trans('inputs.password'),
            'image'         => trans('inputs.model image', ['model' => trans('menu.user')]),
            'department_id' => trans('menu.department'),
            'roles'         => trans('menu.role')
        ];
    }
}
