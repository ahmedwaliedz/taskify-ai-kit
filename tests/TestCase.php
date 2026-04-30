<?php

namespace Taskify\AIKit\Tests;

use Orchestra\Testbench\TestCase as BaseTestCase;
use Taskify\AIKit\TaskifyServiceProvider;

abstract class TestCase extends BaseTestCase
{
    protected function getPackageProviders($app): array
    {
        return [
            TaskifyServiceProvider::class,
        ];
    }
}
