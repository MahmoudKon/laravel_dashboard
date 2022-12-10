<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'name' => 'required|unique:permissions,name,'.request()->route('permission'),
            'roles' => 'nullable|array|min:1',
            'roles.*' => 'required|exists:roles,id'
        ];
    }

    public function attributes()
    {
        return [
			'name' => trans('inputs.name'),
			'roles' => trans('menu.roles'),
        ];
    }
}
