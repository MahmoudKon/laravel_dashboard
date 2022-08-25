<?php

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

/**
 * getUniqueArray
 *
 *  To make push new value to array and return unique array
 *
 * @param  string|array $value
 * @param  string|array|null $push_values
 * @return array
 */
function getUniqueArray(string|array $value, string|array|null $push_values = null) :array
{
    $value = is_array($value) ? $value : explode(',', $value);
    $push_values = is_array($push_values) ? $push_values : explode(',', $push_values);
    $value = array_merge($value, $push_values);
    return empty($value) ? [] : array_unique(array_filter($value));
}



// ****************************************************************************************************************************************************************************************************************** \\
// ******************************************************************* To Make Clone The Email System To Another Project ******************************************************************************************** \\
// ****************************************************************************************************************************************************************************************************************** \\
/**
 *  1- Take copy for Email model from
 *              app\Models\Email
 *  2- Take copy for emails table migration from
 *              database\migrations\
 *  3- Take copy to email page from view path
 *              view/backend/emails
 *  4- Take copy to EmailController From controller path
 *              app\Controllers\Backend\EmailController
 *  5- Take copy to EmailHelper file from app\Helpers\EmailHelper
 *              and put this file in autoload files in composer.json file
 *  6- Take copy to EmailRequest from
 *              app\Http\Requests\EmailRequest
 *  7- Take copy to SendEmail class from
 *              app\Mails\SendEmail, and don't forget to create send-email blade file in view/emails/send-file.blade.php
 *  8- Take copy js and cc files from public/app-assets/backend/customs/emails
 *              and add this constant in first line for js section =>  const ENDPOINT = "{{ routeHelper('/') }}";
 *  9- You shoulde make import for email-notification.js and email.css in master
 *
**/
