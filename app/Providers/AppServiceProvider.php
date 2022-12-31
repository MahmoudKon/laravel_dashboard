<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadAllMigrations();

        \App\Helpers\SettingHelper::setSettingCache();

        \App\Models\User::observe(\App\Observers\UserObserver::class);
        \App\Models\Setting::observe(\App\Observers\SettingObserver::class);
        \App\Models\Announcement::observe(\App\Observers\AnnouncementObserver::class);
        \App\Models\Language::observe(\App\Observers\LanguageObserver::class);
        \App\Models\Client::observe(\App\Observers\ClientObserver::class);
        \App\Models\SocialMedia::observe(\App\Observers\SocialMediaObserver::class);

        Blade::directive('superAdmin', function() { return "<?php if (isSuperAdmin()) { ?>"; });
        Blade::directive('endsuperAdmin', function() { return "<?php } ?>"; });
    }

    protected function loadAllMigrations()
    {
        $migrationsPath = database_path('migrations');
        $directories    = glob($migrationsPath.'/*', GLOB_ONLYDIR);
        $paths          = array_merge([$migrationsPath], $directories);
        $this->loadMigrationsFrom($paths);
    }
}
