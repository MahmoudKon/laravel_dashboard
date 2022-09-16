<?php

use App\Events\NewEmail;
use App\Models\Email;
use App\Models\User;
use Illuminate\Support\Facades\DB;

define('EMAIL_SEEN', 1);
define('EMAIL_UNSEEN', 0);

/**
 * createEmail
 *
 * $email = [
 *      'subject' => string of email subject  [Required]
 *      'body'    => string of email body  [Required]
 *      'to'      => string of email or multi comma separated emails [Required]
 *      'cc'      => string of email or multi comma separated emails [Nullable]
 *      'model'   => string of Model Name [Nullable]
 *      'ids'     => string of Model ids comma separated [Nullable]
 *      'view'    => string of view path [Nullable]
 *  ]
 *
 * @param  array $email
 * @return Email Class
 */
function createEmail(array $data) :Email
{
    DB::beginTransaction();
        $email = Email::create($data);

        $users_id = User::select('id')->whereIn('email', explode(',', $email->to))->when($email->cc, function($query) use ($email) {
            $query->orWhereIn('email', explode(',', $email->cc));
        })->pluck('id')->toArray();

        $email->recipients()->sync($users_id);
        $email->recipients()->attach([auth()->id() => ['is_sender' => true, 'seen' => true, 'seen_time' => now()]]);

        foreach ($users_id as $user_id) {
            broadcast( new NewEmail( $user_id, $email ) );
        }
    DB::commit();
    return $email;
}

/**
 * randomColor
 *
 *  To get the color per the first char
 *
 * @param  string $char
 * @return string
 */
function randomColor(string $char) :string
{
    $colors = [
        'a' => 'info',
        'b' => 'primary',
        'c' => 'success',
        'd' => 'purple',
        'e' => 'yellow',
        'f' => 'cyan',
        'g' => 'danger',
        'h' => 'red',
        'i' => 'pink',
        'j' => 'blue',
        'k' => 'blue-gray',
        'l' => 'amber',
        'm' => 'teal',
        'n' => 'warning',
        'o' => 'info',
        'p' => 'primary',
        'q' => 'success',
        'r' => 'purple',
        's' => 'yellow',
        't' => 'cyan',
        'u' => 'danger',
        'v' => 'red',
        'w' => 'pink',
        'x' => 'blue',
        'y' => 'blue-gray',
        'z' => 'amber',
    ];

    return $colors[ strtolower($char[0]) ];
}

/**
 * getFirstChars
 *
 *  NOTE To get the first char from each word (EX: Mahmoud Mohammed => MM)
 *  ? EX:
 *  ?      Mahmoud Mohammed => MM
 *
 * @param  string $string
 * @return string
 */
function getFirstChars(string $string) :string
{
    $words = explode(" ", $string);
    $chars = '';
    foreach($words as $word) $chars .= $word[0];

    return $chars;
}
