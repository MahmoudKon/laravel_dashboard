<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AggregatorRequest extends FormRequest
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
        return [
            'title' => "required|string|unique:aggregators,title,".request()->route('aggregator'),
            'ratio' => "nullable||numeric|between:0,0.99"
        ];
    }
}
