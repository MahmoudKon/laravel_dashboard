<?php

namespace App\Http\Services;

use App\Models\Aggregator;
use Exception;

class AggregatorService {

    public function handle($request, $id = null)
    {
        try {
            return Aggregator::updateOrCreate(['id' => $id],$request);
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
