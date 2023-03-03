<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class ProfileRequest extends FormRequest
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
        $inputs = [];

        if ($this->form_type == 'info') {
            $inputs = [
                'name' => 'required|string',
            ];

        } else if ($this->form_type == 'password') {
            $inputs = [
                'password' => ['required', new MatchOldPassword, 'different:new_password'],
                'new_password' => [Password::defaults()->min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'],
            ];

        } else if ($this->form_type == 'avatar') {
            $inputs = ['image' => 'required|image|mimes:png,jpg,jpeg'];

        }

        return $inputs;
    }

    public function attributes()
    {
        return [
			'password' => trans('inputs.password'),
			'name' => trans('inputs.name'),
			'image' => trans('inputs.image'),
        ];
    }
}
