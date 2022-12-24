<?php

namespace App\Http\Services;

use Exception;
use App\Models\Governorate;

class GovernorateService
{
    public function handle($request, $id = null)
    {
        try {
            return Governorate::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
