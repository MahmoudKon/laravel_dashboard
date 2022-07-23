<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountryRequest extends FormRequest
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
        $validations = [];

        foreach (config('languages') as $lang) {
            $validations["name"] = 'array|min:1';
            $validations["name.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable')."|string|unique:countries,name->$lang,".request()->route('country');
        }

        return $validations;
    }
}
