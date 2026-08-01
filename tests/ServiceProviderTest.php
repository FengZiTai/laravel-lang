<?php

declare(strict_types=1);

use Fengz\Lang\LangServiceProvider;
use Illuminate\Support\Facades\Artisan;

describe('LangServiceProvider', function () {
    it('publishes all four zh_CN files via the lang.zh-CN tag', function () {
        Artisan::call('vendor:publish', ['--tag' => LangServiceProvider::TAG, '--force' => true]);

        $target = lang_path('zh_CN');

        foreach (['auth.php', 'pagination.php', 'passwords.php', 'validation.php'] as $file) {
            expect($target.DIRECTORY_SEPARATOR.$file)
                ->toBeFile("vendor:publish did not deliver {$file} to lang/zh_CN/");
        }
    });

    it('resolves published translations to Chinese after vendor:publish', function () {
        Artisan::call('vendor:publish', ['--tag' => LangServiceProvider::TAG, '--force' => true]);

        $locale = $this->app->make('translator')->getLocale();

        $this->app->setLocale('zh_CN');

        expect(__('validation.required', ['attribute' => 'name']))
            ->toBe('name 字段必填。')
            ->and(__('auth.failed'))->toBe('这些凭据与我们的记录不匹配。')
            ->and(__('pagination.next'))->toBe('下一页 &raquo;')
            ->and(__('passwords.token'))->toBe('此密码重置令牌无效。');

        $this->app->setLocale($locale);
    });
});
