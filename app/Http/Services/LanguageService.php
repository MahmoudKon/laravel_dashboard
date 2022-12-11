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

    public static function getFlags()
    {
        $countries = json_decode(file_get_contents("http://country.io/names.json"), true);
        $path = 'app-assets'.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.'fonts'.DIRECTORY_SEPARATOR.'flag-icon-css'.DIRECTORY_SEPARATOR.'flags'.DIRECTORY_SEPARATOR.'4x3';
        $icons = [];
        foreach (getFilesInDir( public_path( $path ) ) as $name => $path) {
            $icon = 'flag-icon flag-icon-'.explode('.', $name)[0];
            $short_name = strtoupper( last( explode('-', $icon) ) );
            $icons[$icon] = $countries[$short_name] ?? $short_name;
        }

        return $icons;
    }
}
