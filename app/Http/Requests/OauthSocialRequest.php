<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OauthSocialRequest extends FormRequest
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
        return [
            'display_name' => 'required|string|unique:oauth_socials,display_name,'.request()->oauth_social.'',
			'name' => 'required|string|unique:oauth_socials,name,'.request()->oauth_social.'',
			'icon' => 'nullable|string',
			'color' => 'nullable|string',
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'display_name' => trans('inputs.display_name'),
			'name' => trans('inputs.name'),
			'icon' => trans('inputs.icon'),
			'color' => trans('inputs.color'),
        ];
    }
}
