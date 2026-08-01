<?php

declare(strict_types=1);

/*
|--------------------------------------------------------------------------
| Test Entry Point
|--------------------------------------------------------------------------
|
| Every Pest test in this directory runs inside an Orchestra Testbench
| Laravel application via Tests\TestCase. That base class wires up the
| LangServiceProvider so the publish tag and bundled zh_CN files are
| registered without a real application.
*/

use Fengz\LaravelLang\Tests\TestCase;

uses(TestCase::class)->in(__DIR__);
