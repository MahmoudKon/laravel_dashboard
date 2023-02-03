<?php

namespace App\Helpers;

use App\Models\Language;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\SocialMedia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class SettingHelper
{
    public static function setSettingCache($force = false) :void
    {
        $website_settings = $list_menus = $active_languages = $social_medias = [];
        
        self::clearCache();

        if (! app()->runningInConsole() || $force) {
            $website_settings = self::setSettings();
            $social_medias    = self::setSocialMedias();
            $list_menus       = self::setMenus();
            $active_languages = self::setLanguages();
        }

        self::setRoutePrefix($website_settings['route_prefix'] ?? '');
        self::shareValues($website_settings, $list_menus, $active_languages, $social_medias);
    }

    public static function setSettings() :array
    {
        return Cache::remember('website_settings', 60 * 60 * 24, function () {
                    return Setting::active()->autoload()->pluck('value', 'key')->toArray();
                });
    }

    public static function setSocialMedias() :array
    {
        return Cache::remember('social_medias', 60 * 60 * 24, function () {
                    $rows = [];
                    SocialMedia::isVisible()->select('id', 'name', 'url', 'icon', 'color')->get()->map(function($SocialMedia) use(&$rows) {
                        $rows[$SocialMedia->id] = $SocialMedia->getTemplate();
                    });
                    return $rows;
                });
    }

    public static function setMenus() :Collection|array
    {
        return Cache::remember('list_menus', 60 * 60 * 24, function () {
                    return Schema::hasTable('menus')
                            ? Menu::isParent()->with('visibleSubs')->getVisible()->get()
                            : [];
                });
    }

    public static function setLanguages() :array
    {
        return Cache::remember('active_languages', 60 * 60 * 24, function () {
                    $data = [];
                    foreach (Language::active()->orderBy('short_name', 'ASC')->get() as $lang) {
                        $data[$lang->short_name] = [
                            'short_name' => $lang->short_name,
                            'icon' => $lang->icon,
                            'name' => $lang->name,
                            'native' => $lang->native,
                        ];
                    }
                    return $data;
                });
    }

    public static function setRoutePrefix(?string $prefix) :void
    {
        $prefix = $prefix ?? '';
        $prefix = str_replace(' ', '_', strtolower($prefix));
        if (! defined('URL_PREFIX') ) define('URL_PREFIX', $prefix);
        $prefix_route = $prefix ? "$prefix." : '';
        if (! defined('ROUTE_PREFIX') ) define('ROUTE_PREFIX', $prefix_route);
    }

    public static function shareValues(array $website_settings, $list_menus, array $active_languages, array $social_medias) :void
    {
        View::share([
            'website_settings'  => $website_settings,
            'list_menus'        => $list_menus,
            'active_languages'  => $active_languages,
            'successAudio'      => $website_settings['success_audio'] ?? '',
            'warrningAudio'     => $website_settings['warrning_audio'] ?? '',
            'notificationAudio' => $website_settings['notification_audio'] ?? '',
            'settingLogo'       => $website_settings['logo'] ?? '',
            'social_medias'     => $social_medias
        ]);
    }

    public static function clearCache() :void
    {
        if (! Cache::get('website_settings') || empty( Cache::get('website_settings') ) ) Cache::forget('website_settings');
        if (! Cache::get('list_menus') || empty( Cache::get('list_menus') ) )             Cache::forget('list_menus');
        if (! Cache::get('active_languages') || empty( Cache::get('active_languages') ) ) Cache::forget('active_languages');
        if (! Cache::get('social_medias') || empty( Cache::get('social_medias') ) )       Cache::forget('social_medias');
    }
}
