<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
        return [
            'to' => 'required|array|min:1',
            'cc' => 'nullable|array|min:1',
            'subject' => 'required|string',
            'attachments' => 'array',
            'attachments.*' => 'required|file',
            'body' => 'nullable|string',
        ];
    }

    public function attributes()
    {
        return [
            'to'  => trans('inputs.to'),
            'cc'  => trans('inputs.cc'),
            'subject'  => trans('inputs.subject'),
            'attachments'  => trans('inputs.attachments'),
            'attachments'  => trans('inputs.attachments'),
            'body'  => trans('inputs.body'),
        ];
    }
}
