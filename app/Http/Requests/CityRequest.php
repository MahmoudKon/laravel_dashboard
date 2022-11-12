<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CityRequest extends FormRequest
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
        $validations["governorate_id"] = 'required|exists:governorates,id';
        $validations["name"] = 'required|array|min:1';
        foreach (config('languages') as $lang)
            $validations["name.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable')."|string|unique:cities,name->$lang,".request()->route('city');

        return $validations;
    }

    public function attributes()
    {
        $attributes["name"] = trans('inputs.name');
        $attributes["governorate_id"] = trans('menu.governorate');
        foreach (config('languages') as $lang)
            $attributes["name.$lang"] = trans('inputs.name').' / '.trans("title.$lang");

        return $attributes;
    }
}
