<?php

use App\Models\Language;
use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

function setSettingCache()
{
    $successAudio = $warrningAudio = $notificationAudio = $list_menus = $settingLogo = '';
    $website_settings = $active_languages = [];

    if (! app()->runningInConsole()) {
        $list_menus = Cache::remember('list_menus', 60 * 60 * 24, function () {
            return Schema::hasTable('menus')
                    ? Menu::with('visibleSubs')->parent()->getVisible()->get()
                    : [];
        });

        $website_settings = Cache::remember('website_settings', 60 * 60 * 24, function () {
                                return Setting::active()->autoload()->pluck('value', 'key')->toArray();
                            });

        $active_languages = Cache::remember('active_languages', 60 * 60 * 24, function () {
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

        $settingLogo = $website_settings['logo'] ?? '';
        $notificationAudio = $website_settings['notification_audio'] ?? '';
        $successAudio = $website_settings['success_audio'] ?? '';
        $warrningAudio = $website_settings['warrning_audio'] ?? '';
    }

    View::share([
                    'active_languages'  => $active_languages,
                    'website_settings'  => $website_settings,
                    'successAudio'      => $successAudio,
                    'warrningAudio'     => $warrningAudio,
                    'notificationAudio' => $notificationAudio,
                    'list_menus'        => $list_menus,
                    'settingLogo'       => $settingLogo
                ]);
}
