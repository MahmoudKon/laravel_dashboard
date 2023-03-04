<?php

namespace App\Http\Services;

use App\Models\InputType;
use Exception;

class InputTypeService
{
    public function handle($request, $id = null)
    {
        try {
            return InputType::updateOrCreate(['id' => $id],$request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
