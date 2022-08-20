<?php

use App\Models\Email;
use App\Models\User;
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


// Broadcast::channel('emails.{email}', function ($user, Email $email) {
//     $emails = "$email->to,$email->cc";
//     $emails = array_filter( explode(',', $emails) );
//     return in_array($user->email, $emails);
// });

Broadcast::channel('user.{userId}', function ($user, $userId) {
    return $user->id === $userId;
});

Broadcast::channel('private-email.{email}', function ($user, Email $email) {
    return true;
    $emails = "$email->to,$email->cc";
    $emails = array_filter( explode(',', $emails) );
    return in_array($user->email, $emails);
});
