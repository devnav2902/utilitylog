<?php

namespace Devnav2902\Utilitylog\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Devnav2902\Utilitylog\Classes\UtilityLog;

class UtilityLogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('utilitylog', function (Application $app) {
           return new UtilityLog;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/config.php', 'utilitylog');
        
        $this->loadViewsFrom(__DIR__ . '/../Resources/views', 'utilitylog');
        $this->loadRoutesFrom(__DIR__ . '/../Routes/web.php');

        $this->publishes([
            __DIR__ . '/../Config/config.php' => config_path('utilitylog.php'),
        ], 'utilitylog-config');

        $this->publishes([
            __DIR__ . '/../Resources/views' => resource_path('views/vendor/utilitylog'),
        ], 'utilitylog-views');
    }
}
