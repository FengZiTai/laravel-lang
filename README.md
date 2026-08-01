# fengz/laravel-lang-zh-cn

![Packagist Version](https://img.shields.io/packagist/v/fengz/laravel-lang-zh-cn?label=Packagist)
![Packagist PHP Version](https://img.shields.io/packagist/php-v/fengz/laravel-lang-zh-cn)
![License](https://img.shields.io/packagist/l/fengz/laravel-lang-zh-cn)
![Tests](https://img.shields.io/badge/tests-Pest-7c3aed)

Laravel 简体中文（zh_CN）语言文件包。提供 Laravel 内置翻译键的简体中文译文，通过 `vendor:publish` 发布到你的项目，发布后可自由修改，升级包不会覆盖你的定制。

## 安装

```bash
composer require fengz/laravel-lang-zh-cn
```

包通过 Laravel 包发现自动注册 `LangServiceProvider`，无需手动注册。

## 发布语言文件

```bash
php artisan vendor:publish --tag=lang.zh-CN
```

文件会发布到项目的 `lang/zh_CN/` 目录，包含 Laravel 默认四件套：

- `auth.php` — 认证相关提示
- `pagination.php` — 分页
- `passwords.php` — 密码重置
- `validation.php` — 表单验证

## 配置默认语言

在 `config/app.php` 中设置：

```php
'locale' => 'zh_CN',
'fallback_locale' => 'zh_CN',
```

Laravel 11+ 也可用 `.env`：

```dotenv
APP_LOCALE=zh_CN
APP_FALLBACK_LOCALE=zh_CN
```

设置后，`__('validation.required')`、`$errors` 表单错误提示等会自动使用中文。

## 兼容性

- PHP ^8.5
- Laravel ^13.0
- 翻译文件结构与 Laravel 官方 `en` 版本对齐

## License

MIT License — 详见 [LICENSE](LICENSE)。
