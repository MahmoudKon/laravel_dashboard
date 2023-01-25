<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 *  assetHelper
 *  To return the file path in public folder
 */
function assetHelper(string $path, string $folder = 'backend') :string
{
    return asset("app-assets/$folder/$path");
}

function getRoutePrefex(string $append = '') :string
{
    return getSettingKey('route_prefix', 'dashboard')."$append";
}

function getSettingKey(string $key, string $default) :mixed
{
    return Cache::get('website_settings')[$key] ?? $default;
}

/**
 *  routeHelper
 *  To return the route after route prefix [dashboard/]
 */
function routeHelper(string|null $route, object|array|string|int|null $options = null) :string
{
    if (! $route || $route == '#') return '';
    $route = getRoutePrefex('.').$route;
    return route(trim($route, '.'), $options);
}

/**
 * getUrlQuery
 *
 *  This method to return the query parameters
 *
 * @return string
 */
function getUrlQuery() :string
{
    $arr = explode('?', request()->getRequestUri());
    return isset($arr[1]) && ! empty($arr[1]) ? $arr[1] : '';
}

/**
 *  getModelSlug
 *  get the model class from prameter url like when make edit in model
 */
function getModelSlug(string $model_name, bool $return_id = false) :string|int
{
    $row = null;
    $model_name = str_replace(['{', '}'], ['', ''], $model_name);
    $id = request()->route($model_name);
    if ($return_id) return $id;

    foreach (getFilesInDir(app_path('Models')) as $name => $class) {
        if (stripos($name, $model_name) === false) continue;
        if ($row = app($class)->where('id', $id)->first()) break;
    }

    return $row && method_exists($row, 'slug') ? $row->slug() : $id;
}

function getFilesInDir(string $dir, $specific_class = null) :array|string
{
    $files = [];

    foreach (File::allFiles($dir) as $file) {
        $file_path = str_replace([base_path(), '/', '.php', 'app'], ['', '\\', '', 'App'], $file->getPathname());

        if ($specific_class && "$specific_class.php" == $file->getFilename())
            return $file_path;

        $files[$file->getRelativePathname()] = $file_path;
    }

    return $specific_class ? '' : $files;
}

/**
 *  convertUrlToArray
 *  Get current url and convert it to array
 */
function convertUrlToArray() :array
{
    $routes = request()->route()->uri;
    $routes = str_replace(app()->getLocale().'/', '', $routes);
    return explode('/', $routes);
}

/**
 *  getModel
 *  Get the model from url like [users => user] and the parameter for make it singular or plural
 */
function getModel(bool $singular = false, $view = false) :string
{
    try {
        $controller = request()->route()->getController();
        // in each controller has method [getTableName] to get the model name.
        $table = $controller->getTableName();
    } catch (Exception $e) {
        $route = request()->route()->uri;
        $route = str_replace(app()->getLocale().'/', '', $route);
        $route = str_replace(getRoutePrefex().'/', '', $route);
        $table = explode('/', $route)[0] ?? getRoutePrefex();
    }
    $table = str_replace(' ', '_', $table);

    if ($view) return cache()->get('view_sub_path').$table;
    return $singular ? Str::singular($table) : $table;
}

/**
 *  active
 *  Check if the current url have the value of model parameter to make the link in menu active or not
 */
function activeMenu(string|null $menu_route, string $active_class = 'active') :bool|string
{
    $route = \Illuminate\Support\Facades\Route::getRoutes()->getByName($menu_route);
    if (! $menu_route || ! $route) return '';

    return request()->route()->getAction('controller') == $route->getAction('controller')
                ? $active_class : '';
}

/**
 *  canUser
 *  Check the auth user is super admin to can do any action or check if has permission to do this action
 */
function canUser($permission) :bool
{
    return isSuperAdmin()
            || in_array($permission, auth()->user()->getAllPermissions()->pluck('name')->toArray())
            ? true : false;
}

function setting(string $key, $default = null)
{
    $website_settings = Cache::get('website_settings');
    if(isset($website_settings[$key]))
        return $website_settings[$key];

    $row = \App\Models\Setting::where('key', 'LIKE', "%$key%")->first();

    if (!$row) return $default;
    return $row->active
            ? $row->value ?? $default
            : null;
}

function timeReFormatting($time, $format = 'H:i:s', $included_date = false)
{
    $date = $included_date ? $time : date('Y-m-d'). " $time";
    return $time ? Carbon::parse($date)->format($format) : '';
}

function getDays()
{
    return Carbon::getDays();
}

function convertToArray(array|string $value) :array
{
    if (empty($value) || $value == '' || is_bool($value)) return [];

    return is_array($value) ? $value : explode(',', $value);
}

function truncateTables($tables)
{
    foreach (convertToArray($tables) as $table) {
        Schema::disableForeignKeyConstraints();
            Storage::disk('public')->deleteDirectory("uploads/$table");

            if (Schema::hasTable($table)) {
                DB::table($table)->truncate();
                echo "table $table truncated \n";
            } else {
                echo "table $table doesn't exists \n";
            }
        Schema::enableForeignKeyConstraints();
    }
}

function isSuperAdmin()
{
    return auth()->user()->hasRole(SUPERADMIN_ROLES);
}

function fileExtensions()
{
    return ['jpg', 'jpeg' ,'png' ,'gif' ,'tiff' ,'psd' ,'pdf' ,'eps' ,'ai' ,'indd' ,'raw', 'mp4', 'mov', 'wmv', 'avi', 'avchd', 'flv', 'f4v', 'swf', 'mkv', 'webm', 'mpeg', 'm4v'];
}

function activeLanguages()
{
    $array = [];

    $languages = Cache::get('active_languages') ?? config('laravellocalization.supportedLocales');
    foreach ($languages as $lang => $info)
        $array[$info['native']] = $lang;

    file_put_contents(config_path('languages.php'), "<?php \n\nreturn " . var_export($array, true) . ";");
}

function convertCamelCaseTo(string $string, string $us = '_') :string
{
    return strtolower( preg_replace('/([a-z]+)([A-Z]+)/', '$1'.$us.'$2', $string) );
}

function transListRows($model = 'menu.users')
{
    return trans('menu.list-rows', ['model' => trans($model)]);
}
