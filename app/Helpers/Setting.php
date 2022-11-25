<?php

use App\Models\Menu;
use App\Models\Setting;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

function setSettingCache()
{
    $successAudio = $warrningAudio = $notificationAudio = $list_menus = $settingLogo = '';
    $website_settings = [];

    if (! app()->runningInConsole()) {
        $list_menus = Cache::remember('list_menus', 60 * 60 * 24, function () {
            return Schema::hasTable('menus')
                    ? Menu::with('visibleSubs')->parent()->getVisible()->get()
                    : [];
        });

        $website_settings = Cache::remember('website_settings', 60 * 60 * 24, function () {
                                return Setting::active()->autoload()->pluck('value', 'key')->toArray();
                            });

        $settingLogo = $website_settings['logo'] ?? '';
        $notificationAudio = $website_settings['notification_audio'] ?? '';
        $successAudio = $website_settings['success_audio'] ?? '';
        $warrningAudio = $website_settings['warrning_audio'] ?? '';
        // $settingLogo = Cache::remember('logo', 60 * 60 * 24, function () { return setting('logo', env('APP_NAME')); });
        // $notificationAudio = Cache::remember('notification_audio', 60 * 60 * 24, function () { return setting('notification_audio', 'samples/audios/success.mp3'); });
        // $successAudio = Cache::remember('success_audio', 60 * 60 * 24, function () { return setting('success_audio', 'samples/audios/success.mp3'); });
        // $warrningAudio = Cache::remember('warrning_audio', 60 * 60 * 24, function () { return setting('warrning_audio', 'samples/audios/warrning.mp3'); });
    }

    View::share([
                    'website_settings'  => $website_settings,
                    'successAudio'      => $successAudio,
                    'warrningAudio'     => $warrningAudio,
                    'notificationAudio' => $notificationAudio,
                    'list_menus'        => $list_menus,
                    'settingLogo'       => $settingLogo
                ]);
}
