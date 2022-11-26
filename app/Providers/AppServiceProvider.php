<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\Setting;
use App\Models\User;
use App\Observers\AnnouncementObserver;
use App\Observers\SettingObserver;
use App\Observers\UserObserver;
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
        activeLanguages();
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadAllMigrations();

        setSettingCache();

        User::observe(UserObserver::class);
        Setting::observe(SettingObserver::class);
        Announcement::observe(AnnouncementObserver::class);

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
