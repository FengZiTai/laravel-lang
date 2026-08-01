<?php

declare(strict_types=1);

namespace Fengz\LaravelLang;

use Illuminate\Foundation\Console\AboutCommand;
use Illuminate\Support\ServiceProvider;

class LangServiceProvider extends ServiceProvider
{
    /**
     * Package version, surfaced in `php artisan about`.
     */
    public const VERSION = '0.1.0';

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
                [$this->langPath() => lang_path('zh_CN')],
                self::TAG,
            );
        }

        AboutCommand::add('Laravel Lang zh-CN', fn () => ['Version' => self::VERSION]);
    }

    /**
     * Resolve the bundled zh_CN source directory.
     */
    protected function langPath(): string
    {
        return dirname(__DIR__).DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh_CN';
    }
}
