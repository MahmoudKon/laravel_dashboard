<?php

namespace App\Http\Services;

use Exception;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

class LanguageService
{
    public function handle($request, $id = null)
    {
        try {
            return Language::updateOrCreate(['id' => $id], $request);
        } catch (Exception $e) {
            return $e;
        }
    }

    public static function getFlags() :array
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

    public static function getFiles(string $short_name) :array
    {
        $files = [];
        if ( ! File::exists( lang_path( $short_name ) ) ) return $files;
        foreach (File::allFiles( lang_path( $short_name ) ) as $index => $file) {
            $file_name = str_replace('.php', '', $file->getRelativePathname());
            $files[$index] = [
                'name' => $file_name,
                'count' => count( Lang::get( $file_name ) ),
                'size' => $file->getSize(),
            ];
        }

        return $files;
    }

    public static function getTrans(string $file, string $short_name) :object
    {
        $rows = [];
        self::convertArray(Lang::get( $file, locale: $short_name ), $rows);
        return self::convertArrayToCollection($rows, 10, request()->get('page'));
    }


    public static function transStore(string $file, string $short_name, $request) :void
    {
        $file = lang_path( "$short_name/$file.php" );
        $contents = file($file);
        $size = count($contents);
        $contents[$size -1] = "\n\t\t'$request->key' => '$request->trans',\n".$contents[$size-1];
        file_put_contents($file, $contents);
    }

    public static function transUpdate(string $file, string $short_name, string $key) :void
    {
        $file = lang_path( "$short_name/$file.php" );
        $content = explode("\n", file_get_contents( $file ));

        foreach ($content as $index => $val) {
            if ( stripos( $val, "'$key'" ) !== false || stripos( $val, "\"$key\"" ) !== false ) {
                $content[$index] = "\t\t'$key' => '".request()->input('trans')."',";
            }
        }

        file_put_contents($file, implode("\n", $content));
    }

    public static function convertArray(array $rows, array &$arr) :void
    {
        foreach ($rows as $key => $value) {
            if ( is_array( $value ) ) {
                self::convertArray($value, $arr);
            } else {
                $arr[$key] = $value;
            }
        }
    }

    public static function convertArrayToCollection(array $items, int $perPage = 5, int|null $page = null, array $options = []) :object
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
