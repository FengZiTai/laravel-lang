<?php

declare(strict_types=1);

namespace Fengz\Lang\Tests;

use Fengz\Lang\LangServiceProvider;
use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Service providers registered in the testbench app.
     *
     * @param  Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [LangServiceProvider::class];
    }
}
