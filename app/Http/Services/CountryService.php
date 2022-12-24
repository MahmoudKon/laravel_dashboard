<?php

namespace App\Http\Services;

use App\Models\Country;
use Exception;

class CountryService
{
    public function handle($request, $id = null)
    {
        try {
            return Country::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
