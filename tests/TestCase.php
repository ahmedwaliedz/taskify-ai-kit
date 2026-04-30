<?php

namespace Taskify\AIKit\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Taskify\AIKit\Console\InstallTaskifyCommand;
use Taskify\AIKit\TaskifyServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            TaskifyServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        $this->app->booted(function () {
            $this->app->make('Illuminate\Console\ConsoleKernel')->add(InstallTaskifyCommand::class);
        });
    }
}
