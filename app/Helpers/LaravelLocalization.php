<?php

namespace App\Helpers;

use Mcamara\LaravelLocalization\LaravelLocalization as McamaraLaravelLocalization;

class LaravelLocalization extends McamaraLaravelLocalization
{
    /**
     * Returns current locale name.
     *
     * @return string current flag name
     */
    public function getCurrentFlagName()
    {
        return $this->supportedLocales[app()->getLocale()]['flag'] ?? 'us';
    }
}
