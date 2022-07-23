<?php

namespace App\Listeners;

use App\Models\User;
use App\Notifications\NewUserNotifications;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class SendNewUserNotifications
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $admins = User::whereHas('roles', function ($query) {
            return $query->where('name', 'Super Admin');
        })->get();

        Notification::Send($admins, new NewUserNotifications($event->user));
    }
}
