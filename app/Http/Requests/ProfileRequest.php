<?php

namespace App\Http\Requests;

use App\Rules\MatchOldPassword;
use Illuminate\Foundation\Http\FormRequest;

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
                'behalf_id' => 'nullable|exists:users,id'
            ];

        } else if ($this->form_type == 'password') {
            $inputs = [
                'password' => ['required', new MatchOldPassword, 'different:new_password'],
                'new_password' => 'required|same:password_confirmation',
            ];

        } else if ($this->form_type == 'avatar') {
            $inputs = ['image' => 'required|image|mimes:png,jpg,jpeg'];

        } else if ($this->form_type == 'roles') {
            $inputs = ['roles' => 'nullable|array'];

        } else if ($this->form_type == 'permissions') {
            $inputs = ['permissions' => 'nullable|array'];

        }

        return $inputs;
    }
}
