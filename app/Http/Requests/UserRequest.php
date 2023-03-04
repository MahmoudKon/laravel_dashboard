<?php

namespace App\Http\Requests;

use App\Traits\HandleValidationError;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class UserRequest extends FormRequest
{
    use HandleValidationError;
    
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
            'image'         => 'nullable|image|mimes:png,jpg,gif',
            'roles'         => 'nullable|array',
        ];
    }

    public function attributes()
    {
        return [
            'name'          => trans('inputs.model name', ['model' => trans('menu.user')]),
            'email'         => trans('inputs.email'),
            'password'      => trans('inputs.password'),
            'image'         => trans('inputs.file'),
            'roles'         => trans('menu.role')
        ];
    }

    protected function prepareForValidation()
    {
        if (is_null($this->password) || ! $this->has('password'))
            $this->request->remove('password');
    }
}
