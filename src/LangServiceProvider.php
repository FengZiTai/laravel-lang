<?php

declare(strict_types=1);

namespace Fengz\Lang;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class LangServiceProvider extends ServiceProvider
{
    /**
     * Package version, surfaced in `php artisan about`.
     */
    public const VERSION = '0.2.0';

    /**
     * Publish tag used by `php artisan vendor:publish --tag=lang.zh-CN`.
     */
    public const TAG = 'lang.zh-CN';

    /**
     * Bootstrap package services.
     */
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    $this->langPath('zh_CN') => lang_path('zh_CN'),
                    $this->langPath('zh_CN.json') => lang_path('zh_CN.json'),
                ],
                self::TAG,
            );
        }

        AboutCommand::add('Laravel Lang zh-CN', fn () => ['Version' => self::VERSION]);
    }

    /**
     * Resolve a path relative to the bundled lang/ directory.
     */
    protected function langPath(string $path = ''): string
    {
        $base = dirname(__DIR__).DIRECTORY_SEPARATOR.'lang';

        return $path === '' ? $base : $base.DIRECTORY_SEPARATOR.$path;
    }
}
