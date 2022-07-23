<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'image' => 'nullable|image|mimes:png,jpg,jpeg',
            'parent_id' => 'nullable|exists:categories,id',
        ];

        foreach (config('languages') as $lang) {
            $validations["name"] = 'nullable|array';
            $validations["name.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable')."|string|unique:categories,name->$lang,".request()->route('category');
        }

        return $validations;
    }
}
