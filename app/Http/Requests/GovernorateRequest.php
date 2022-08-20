<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GovernorateRequest extends FormRequest
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
        $validations["name"] = 'required|array|min:1';
        foreach (config('languages') as $lang)
            $validations["name.$lang"] = ($lang == app()->getLocale() ? 'required' : 'nullable')."|string|unique:governorates,name->$lang,".request()->route('governorate');

        return $validations;
    }
    
    public function attributes()
    {
        foreach (config('languages') as $lang)
            $attributes["name.$lang"] = trans('inputs.name') .' / '. trans("title.$lang");
        
        return $attributes;
    }
}
