<?php

namespace App\Http\Services;

use Exception;
use App\Models\Language;

class LanguageService
{
    public function handle($request, $id = null)
    {
        try {
            $row = Language::updateOrCreate(['id' => $id], $request);
            return $row;
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
