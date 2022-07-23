<?php

namespace App\Observers;

use App\Models\User;
use App\Traits\UploadFile;

class UserObserver
{
    use UploadFile;

    /**
     * Handle the User "updated" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function updated(User $user)
    {
        if ($user->isDirty('image')) {
            $this->remove($user->getOriginal('image'));
        }
    }

    /**
     * Handle the User "deleted" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function deleted(User $user)
    {
        $this->remove($user->image);
    }
}
