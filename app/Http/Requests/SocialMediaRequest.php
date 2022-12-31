<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
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
            'name'  => 'required|string|unique:social_medias,name,'.request()->social_media,
			'url'   => 'required|url',
			'icon'  => 'required|string',
			'color' => 'required|string',
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
            'name'  => trans('inputs.name'),
			'url'   => trans('inputs.url'),
			'icon'  => trans('inputs.icon'),
			'color' => trans('inputs.color'),
        ];
    }
}
