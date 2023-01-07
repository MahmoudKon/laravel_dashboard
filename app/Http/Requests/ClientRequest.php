<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ClientRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $pass_validation = request()->route('client') ? "nullable" : "required";
        return [
            'username' => 'required|string|unique:clients,username,'.request()->route('client'),
			'email' => 'required|string|unique:users,email|unique:clients,email,'.request()->route('client'),
            'password' => [$pass_validation, Password::defaults()->min(8)->mixedCase()->numbers()->symbols()->uncompromised()],
			'phone' => 'nullable|string|min:11|unique:clients,phone,'.request()->route('client'),
			'image' => 'nullable|image|mimes:png,jpg,jpeg'
        ];
    }

    public function attributes()
    {
        return [
            'username' => trans('inputs.username'),
			'email' => trans('inputs.email'),
			'password' => trans('inputs.password'),
			'phone' => trans('inputs.phone'),
			'image' => trans('inputs.image')
        ];
    }
}
