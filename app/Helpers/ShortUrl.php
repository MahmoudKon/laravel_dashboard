<?php

namespace App\Helpers;

class ShortUrl
{
    protected const ENDPOINT = "http://souqalbadr.top/short-url/api/shorten";

    public static function shorten(string $route)
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => self::ENDPOINT,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "url=$route",
        ]);

        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);

        return $response->short_uri ?? $route;
    }
}
