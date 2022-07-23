<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
            'route' => 'required|string',
            'route' => 'nullable|string',
            'icon'  => 'nullable|string',
            'parent_id' => 'nullable|exists:menus,id',
        ];
        foreach (config('languages') as $lang) {
            $validations["name"] = 'nullable|array';
            $validations["name.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable').'|string';
        }

        return $validations;
    }
}
