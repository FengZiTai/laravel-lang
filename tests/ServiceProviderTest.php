<?php

declare(strict_types=1);

use Fengz\Lang\LangServiceProvider;
use Illuminate\Support\Facades\Artisan;

describe('LangServiceProvider', function () {
    it('publishes all zh_CN files via the lang.zh-CN tag', function () {
        Artisan::call('vendor:publish', ['--tag' => LangServiceProvider::TAG, '--force' => true]);

        $dir = lang_path('zh_CN');

        foreach (['auth.php', 'pagination.php', 'passwords.php', 'validation.php'] as $file) {
            expect($dir.DIRECTORY_SEPARATOR.$file)
                ->toBeFile("vendor:publish did not deliver {$file} to lang/zh_CN/");
        }

        expect(lang_path('zh_CN.json'))
            ->toBeFile('vendor:publish did not deliver zh_CN.json to lang/');
    });

    it('resolves published translations to Chinese after vendor:publish', function () {
        Artisan::call('vendor:publish', ['--tag' => LangServiceProvider::TAG, '--force' => true]);

        $locale = $this->app->make('translator')->getLocale();

        $this->app->setLocale('zh_CN');

        // PHP translation file (validation/auth/pagination/passwords).
        expect(__('validation.required', ['attribute' => 'name']))
            ->toBe('name 不能为空。')
            ->and(__('auth.failed'))->toBe('这些凭据与我们的记录不匹配。')
            ->and(__('pagination.next'))->toBe('下一页 &raquo;')
            ->and(__('passwords.token'))->toBe('此密码重置令牌无效。');

        // JSON translation file (framework error pages / mail templates).
        expect(__('Page Expired'))->toBe('页面已过期')
            ->and(__('Reset Password'))->toBe('重置密码')
            ->and(__('Server Error'))->toBe('服务器错误')
            ->and(__('Whoops!'))->toBe('哎呀！');

        $this->app->setLocale($locale);
    });
});
