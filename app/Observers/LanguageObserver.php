<?php

namespace App\Observers;

use App\Models\Language;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class LanguageObserver
{
    /**
     * Handle the created "updated" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function created(Language $language)
    {
        $this->updateCache($language);
    }

    /**
     * Handle the Language "updated" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function updated(Language $language)
    {
        $language->refresh();
        $this->updateCache($language);
    }

    /**
     * Handle the Language "deleted" event.
     *
     * @param  \App\Models\Language  $language
     * @return void
     */
    public function deleted(Language $language)
    {
        $this->updateCache($language, true);
    }

    protected function updateCache($language, $force_remove = false)
    {
        $active_languages = Cache::get('active_languages');
        Cache::forget('active_languages');

        if ($language->active && !$force_remove)
            $active_languages[$language->short_name] = [
                'icon' => $language->icon,
                'name' => $language->name,
                'native' => $language->native,
            ];
        else
            $this->unsetKey($active_languages, $language);

        $this->updateFile($language);
        Cache::remember('active_languages', 60 * 60 * 24, function() use($active_languages) { return $active_languages; });
        activeLanguages();
    }

    protected function unsetKey(&$active_languages, $language)
    {
        if(isset($active_languages[$language->short_name]))
            unset($active_languages[$language->short_name]);
    }

    protected function updateFile($language)
    {
        $file = config_path('laravellocalization.php');
        $content = file_get_contents( $file );

        if ($language->active) {
            if (! File::exists(lang_path( $language->short_name )) )
                File::copyDirectory( lang_path('en'), lang_path( $language->short_name ) );

            if(strpos($content, "//'$language->short_name'") !== false)
                $content = str_replace(" //'$language->short_name'", "'$language->short_name'", $content);
        } else {
            if(strpos($content, "//'$language->short_name'") === false)
                $content = str_replace(" '$language->short_name'", "//'$language->short_name'", $content);
        }

        file_put_contents($file, $content);
    }
}
