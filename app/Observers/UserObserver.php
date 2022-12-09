<?php

namespace App\Observers;

use App\Models\Role;
use App\Models\User;
use App\Traits\UploadFile;

class UserObserver
{
    use UploadFile;

    /**
     * Handle the User "creating" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function creating(User $user)
    {
        $user->code = $user->code ?? User::generateCode();
    }

    /**
     * Handle the User "created" event.
     *
     * @param  \App\Models\User  $user
     * @return void
     */
    public function created(User $user)
    {
        if ( $user->roles()->count() == 0 )
            $user->syncRoles( Role::whereIn('name', BASIC_ROLES)->pluck('id')->toArray() );
    }

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
