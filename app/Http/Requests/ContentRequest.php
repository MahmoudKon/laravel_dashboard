<?php

namespace App\Http\Requests;

use App\Constants\ContentType;
use Illuminate\Foundation\Http\FormRequest;

class ContentRequest extends FormRequest
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
        foreach (config('languages') as $lang) {
            $validations["title"] = 'required|array|min:1';
            $validations["title.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable').'|string';
        }

        $validations['category_id'] = 'required|exists:categories,id';
        $validations['content_type_id'] = 'required|exists:content_types,id';
        $validations['patch_number'] = 'nullable|numeric';

        $validations = array_merge($validations, ContentType::validaionHandler($this->content_type_id));
        return $validations;
    }
}
