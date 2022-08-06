<?php

namespace App\Observers;

use App\Constants\SettingType;
use App\Models\Setting;
use App\Traits\UploadFile;

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
        if ($Setting->isDirty('value') && in_array($Setting->content_type_id, [SettingType::AUDIO, SettingType::VIDEO, SettingType::IMAGE])) {
            $this->remove($Setting->getOriginal('value'));
        }

        if ($Setting->key == "default_lang") {
            session()->forget('locale');
        }
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
    }
}
