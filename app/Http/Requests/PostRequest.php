<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'content_id'    => 'required|exists:contents,id',
            'operator_id'   => 'required|exists:operators,id',
            'active'        => 'nullable|in:0,1',
            'published_date'=> 'required|date|date_format:Y-m-d',
        ];
    }
}
