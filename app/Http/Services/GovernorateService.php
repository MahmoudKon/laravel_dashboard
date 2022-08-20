<?php

namespace App\Http\Services;

use Exception;
use App\Models\Governorate;

class GovernorateService {

    public function handle($request, $id = null)
    {
        try {
            $row = Governorate::updateOrCreate(['id' => $id], $request);
            return $row;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
