<?php

namespace App\Http\Services;

use App\Models\ContentType;
use Exception;

class ContentTypeService
{
    public function handle($request, $id = null)
    {
        try {
            return ContentType::updateOrCreate(['id' => $id],$request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
