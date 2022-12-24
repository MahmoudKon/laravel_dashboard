<?php

namespace App\Http\Services;

use Exception;
use App\Models\City;

class CityService
{
    public function handle($request, $id = null)
    {
        try {
            return City::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
