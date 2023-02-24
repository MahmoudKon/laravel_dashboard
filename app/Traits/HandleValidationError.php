<?php

namespace App\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait HandleValidationError
{
    public function failedValidation(Validator $validator)
    {
        if (request()->is('api/*')) {
            throw new HttpResponseException(response()->json([
                'success'   => false,
                'message'   => 'Validation errors',
                'errors'    => $this->getErrorsAsArray( $validator->errors()->getMessages() )
            ], 422));
        } else {
            parent::failedValidation($validator);
        }
    }

    protected function getErrorsAsArray(array $errors): array
    {
        $rows = [];

        foreach ($errors as $key => $error)
            $rows[$key] = $error[0];

        return $rows;
    }
}