<?php

namespace DevPirate\LaraReportCraft\Providers;

use DevPirate\LaraReportCraft\Console\Kernel;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class LaraReportCraftProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                //
            ]);
        }

        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'lara_report_craft');
        Blade::componentNamespace('DevPirate\\LaraReportCraft\\View\\Components', 'lara-report-craft');

        $folderPath = public_path('vendor/lara-report-craft');

        $this->publishes([
            __DIR__ . '/../../public' => $folderPath,
        ], 'lara-report-craft-assets');

        $this->publishes([
            __DIR__ . '/../../config/lara-report-craft.php' => config_path('lara-report-craft.php'),
        ], 'config');
    }

    public function register()
    {
        $this->app->singleton('lara_report_craft.console.kernel', function ($app, $events) {
            return new Kernel($app, $events);
        });
    }
}
