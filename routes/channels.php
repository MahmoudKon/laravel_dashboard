<?php

use App\Models\Email;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// Broadcast::channel('new-email.{email_id}', function (User $user, $email) {
//         return true;
//     $emails = "$email->to,$email->cc,$email->do";
//     $emails = array_filter( explode(',', $emails) );
//     return in_array($user->email, $emails);
// });


Broadcast::channel('new-email.{email}', function ($user, Email $email) {
    return in_array($user->id, $email->recipients()->pluck('id')->to_array());
});
