<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OperatorRequest extends FormRequest
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
        $validations ['country_id']= 'required|exists:countries,id';

        foreach (config('languages') as $lang) {
            $validations["name"] = 'array|min:1';
            $validations["name.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable')."|string|unique:operators,name->$lang,".request()->route('operator');
        }

        return $validations;
    }
}
