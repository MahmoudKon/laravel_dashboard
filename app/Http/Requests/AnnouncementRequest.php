<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
			'title' => 'required|string|max:200',
			'desc' => 'nullable|string',
			'start_date' => 'required|date_format:Y-m-d H:i',
			'end_date' => 'required|after_or_equal:start_date|date_format:Y-m-d H:i',
			'url' => 'required|string|url|active_url',
			'image' => 'nullable|image|mimes:png,jpg',
			'open_type' => 'nullable|boolean|in:1,0',
        ];
    }

    public function attributes()
    {
        return [
			'title' => trans('inputs.title'),
			'desc' => trans('inputs.desc'),
			'start_date' => trans('inputs.start_date'),
			'end_date' => trans('inputs.end_date'),
			'url' => trans('inputs.url'),
			'image' => trans('inputs.image'),
			'open_type' => trans('inputs.open_type'),
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'open_type' => $this->open_type ?? 0,
        ]);
    }
}
