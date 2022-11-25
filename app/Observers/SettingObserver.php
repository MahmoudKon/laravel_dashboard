<?php

namespace App\Observers;

use App\Constants\SettingType;
use App\Models\Setting;
use App\Traits\UploadFile;
use Illuminate\Support\Facades\Cache;

class SettingObserver
{
    use UploadFile;

    /**
     * Handle the Setting "updated" event.
     *
     * @param  \App\Models\Setting  $Setting
     * @return void
     */
    public function updated(Setting $Setting)
    {
        $Setting->refresh();
        $Setting->load('contentType');

        if ($Setting->isDirty('value') && in_array($Setting->contentType->name, [SettingType::AUDIO, SettingType::VIDEO, SettingType::IMAGE])) {
            $this->remove($Setting->getOriginal('value'));
        }

        if ($Setting->key == "default_lang")
            session()->forget('locale');

        $this->updateCache($Setting);
    }

    /**
     * Handle the Setting "deleted" event.
     *
     * @param  \App\Models\Setting  $Setting
     * @return void
     */
    public function deleted(Setting $Setting)
    {
        $this->remove($Setting->value);
        $this->updateCache($Setting, true);
    }

    protected function updateCache($setting, $force_remove = false)
    {
        $website_settings = Cache::get('website_settings');
        Cache::forget('website_settings');

        if ($setting->autoload && $setting->active && !$force_remove)
            $website_settings[$setting->key] = $setting->value;
        else
            $this->unsetKey($website_settings, $setting);

        Cache::remember('website_settings', 60 * 60 * 24, function() use($website_settings) { return $website_settings; });
    }

    protected function unsetKey(&$website_settings, $setting)
    {
        if(isset($website_settings[$setting->key]))
            unset($website_settings[$setting->key]);
    }
}
