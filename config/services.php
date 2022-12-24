<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID', 'Iv1.0455ac100c34e2ad'),
        'client_secret' => env('GITHUB_CLIENT_SECRET', '118569615262fb04a8c20976d367870b375b144a'),
        'redirect' => env('SOCIALITE_REDIRECT'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', "1079002974610-aav9o2gv8kpas62nleq6l9f37gf0oc2f"),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', "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"),
        'redirect' => env('SOCIALITE_REDIRECT'),
    ],
    'gitlab' => [
        'client_id' => env('GITLAB_CLIENT_ID'),
        'client_secret' => env('GITLAB_CLIENT_SECRET'),
        'redirect' => env('SOCIALITE_REDIRECT'),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID'),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET'),
        'redirect' => env('SOCIALITE_REDIRECT'),
    ],
];
