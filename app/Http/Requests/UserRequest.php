<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'name'          => 'required',
            'email'         => 'required|email|unique:users,email,'.request()->route('user'),
            'password'      => 'required_without:id',
            'image'         => 'nullable',
            'department_id' => 'required|exists:departments,id',
            'aggregator_id' => 'nullable|exists:aggregators,id',
            'behalf_id'     => 'required|exists:users,id',
            'roles'         => 'nullable|array',
            'annual_credit' => 'nullable|numeric|min:0',
            'finger_print_id' => 'nullable|numeric|min:1|unique:users,finger_print_id,'.request()->route('user'),
            'salary_per_monthly' => 'nullable|numeric|min:1'
        ];
    }
}
