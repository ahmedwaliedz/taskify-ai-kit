<?php

namespace Taskify\AIKit;

use Illuminate\Support\ServiceProvider;
use Taskify\AIKit\Console\InstallTaskifyCommand;

class TaskifyServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallTaskifyCommand::class,
            ]);

            // Publish stubs
            $this->publishes([
                __DIR__.'/../stubs/ai' => base_path('.ai'),
                __DIR__.'/../stubs/PROJECT_CONTEXT.md' => base_path('PROJECT_CONTEXT.md'),
                __DIR__.'/../stubs/features/_example_' => base_path('features/_example_'),
            ], 'taskify-stubs');

            // Publish config
            $this->publishes([
                __DIR__.'/../config/taskify.php' => config_path('taskify.php'),
            ], 'taskify-config');
        }
    }

    /**
     * Register the service provider.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/taskify.php', 'taskify');

        $this->commands([
            InstallTaskifyCommand::class,
        ]);
    }
}
