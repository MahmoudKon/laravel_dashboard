<?php

namespace App\Http\Requests;

use App\Constants\SettingType;
use Illuminate\Foundation\Http\FormRequest;

class SettingRequest extends FormRequest
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
        $validations = [
            'key' => 'required_without:id|string|unique:settings,key,'.request()->route('setting'),
            'active' => 'required|boolean',
            'content_type_id' => 'required|exists:content_types,id',
        ];

        return array_merge($validations, SettingType::validaionHandler($this->content_type_id));
    }

    public function attributes()
    {
        return [
			'key' => trans('inputs.key'),
			'active' => trans('inputs.active'),
			'content_type_id' => trans('menu.content_type'),
        ];
    }
}
