<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContentTypeRequest extends FormRequest
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
            'name' => 'required|string|unique:content_types,name,'.request()->route('content_type'),
        ];
    }

    public function attributes()
    {
        return [
            'name' => trans('inputs.name')
        ];
    }
}
