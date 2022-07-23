<?php

namespace App\Http\Services;

use App\Models\Operator;
use App\Traits\UploadFile;
use Exception;

class OperatorService {
    use UploadFile;

    public function handle($request, $id = null)
    {
        try {
            return Operator::updateOrCreate(['id' => $id],$request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
