<?php

namespace App\Observers;

use App\Models\Announcement;
use App\Traits\UploadFile;

class AnnouncementObserver
{
    use UploadFile;

    /**
     * Handle the Announcement "updated" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function updated(Announcement $announcement)
    {
        if ($announcement->isDirty('image')) {
            $this->remove($announcement->getOriginal('image'));
        }
    }

    /**
     * Handle the Announcement "deleted" event.
     *
     * @param  \App\Models\Announcement  $announcement
     * @return void
     */
    public function deleted(Announcement $announcement)
    {
        $this->remove($announcement->image);
    }
}
