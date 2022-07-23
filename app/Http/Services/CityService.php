<?php

namespace App\Http\Services;

use Exception;
use App\Models\City;

class CityService {

    public function handle($request, $id = null)
    {
        try {
            $row = City::updateOrCreate(['id' => $id], $request);
            return $row;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
