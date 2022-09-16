<?php

namespace App\Http\Requests\Messenger;

use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
            'message'           => 'required_without:file',
            'file'              => 'nullable|file',
            'conversation_id'   => 'nullable|required_without:user_id|exists:conversations,id',
            'user_id'           => 'nullable|required_without:conversation_id|exists:users,id',
        ];
    }
}
