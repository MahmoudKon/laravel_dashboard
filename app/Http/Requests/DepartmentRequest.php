<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
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
            'title' => 'required|string|unique:departments,title,'.request()->route('department'),
            'email' => 'required|email|unique:departments,email,'.request()->route('department'),
            'manager_id' => 'required|numeric|exists:users,id',
        ];
    }

    public function attributes()
    {
        return [
            'title' => trans('inputs.title'),
            'email' => trans('inputs.email'),
            'manager_id' => trans('inputs.manager'),
        ];
    }
}
