<?php

namespace App\Observers;

use App\Models\SocialMedia;
use Illuminate\Support\Facades\Cache;

class SocialMediaObserver
{
    /**
     * Handle the SocialMedia "created" event.
     *
     * @param  \App\Models\SocialMedia  $social_media
     * @return void
     */
    public function created(SocialMedia $social_media)
    {
        $this->updateCache($social_media);
    }

    /**
     * Handle the SocialMedia "updated" event.
     *
     * @param  \App\Models\SocialMedia  $social_media
     * @return void
     */
    public function updated(SocialMedia $social_media)
    {
        $this->updateCache($social_media);
    }

    /**
     * Handle the SocialMedia "deleted" event.
     *
     * @param  \App\Models\SocialMedia  $social_media
     * @return void
     */
    public function deleted(SocialMedia $social_media)
    {
        $this->updateCache($social_media, true);
    }

    protected function updateCache($social_media, $force_remove = false)
    {
        $social_medias = Cache::get('social_medias');
        Cache::forget('social_medias');

        if ($social_media->is_visible && !$force_remove)
            $this->setKey($social_medias, $social_media);
        else
            $this->unsetKey($social_medias, $social_media);

        Cache::remember('social_medias', 60 * 60 * 24, function() use($social_medias) { return $social_medias; });
    }

    protected function setKey(&$social_medias, $social_media)
    {
        $social_medias[$social_media->id] = $social_media->getTemplate(true);
        ksort($social_medias);
    }

    protected function unsetKey(&$social_medias, $social_media)
    {
        if(isset($social_medias[$social_media->id]))
            unset($social_medias[$social_media->id]);
    }
}
