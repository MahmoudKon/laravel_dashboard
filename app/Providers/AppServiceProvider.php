<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Setting;
use App\Models\User;
use App\Observers\SettingObserver;
use App\Observers\UserObserver;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
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
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadAllMigrations();

        User::observe(UserObserver::class);
        Setting::observe(SettingObserver::class);

        // Cache::forget('list_menus');
        if (! app()->runningInConsole()) {
            $list_menus = Cache::remember('list_menus', 60 * 60 * 24, function () {
                return Menu::with('visibleSubs')->parent()->getVisible()->get();
            });

            $successAudio = Cache::remember('successAudio', 60 * 60 * 24, function () { return setting('success_audio', 'samples/audios/success.mp3'); });
            $warrningAudio = Cache::remember('warrningAudio', 60 * 60 * 24, function () { return setting('warrning_audio', 'samples/audios/warrning.mp3'); });
            View::share(['list_menus' => $list_menus, 'successAudio' => $successAudio, 'warrningAudio' => $warrningAudio]);
        } else {
            View::share(['list_menus' => [], 'successAudio' => '', 'warrningAudio' => '']);
        }

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
