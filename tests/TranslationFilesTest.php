<?php

declare(strict_types=1);

use Fengz\Lang\LangServiceProvider;

/**
 * Resolve the bundled zh_CN source directory.
 */
function zhCnPath(): string
{
    $ref = new ReflectionClass(LangServiceProvider::class);

    return dirname($ref->getFileName(), 2).DIRECTORY_SEPARATOR.'lang'.DIRECTORY_SEPARATOR.'zh_CN';
}

/**
 * Resolve Laravel's authoritative en source directory from vendor.
 */
function enPath(): string
{
    return __DIR__.'/../vendor/laravel/framework/src/Illuminate/Translation/lang/en';
}

/**
 * Flatten a nested array into dot-notation keys.
 *
 * @param  array<string, mixed>  $array
 * @return list<string>
 */
function flattenKeys(array $array, string $prefix = ''): array
{
    $keys = [];

    foreach ($array as $key => $value) {
        $full = $prefix === '' ? (string) $key : $prefix.'.'.(string) $key;

        if (is_array($value)) {
            foreach (flattenKeys($value, $full) as $child) {
                $keys[] = $child;
            }
        } else {
            $keys[] = $full;
        }
    }

    return $keys;
}

describe('translation files', function () {
    it('returns an array for every zh_CN file', function (string $file) {
        $path = zhCnPath().DIRECTORY_SEPARATOR.$file;

        expect(file_exists($path))->toBeTrue("Missing file: {$file}");

        $lines = require $path;

        expect(is_array($lines))->toBeTrue("{$file} must return an array");
    })->with([
        'auth.php',
        'pagination.php',
        'passwords.php',
        'validation.php',
    ]);

    it('has every key that the Laravel en source defines', function (string $file) {
        $en = require enPath().DIRECTORY_SEPARATOR.$file;
        $zh = require zhCnPath().DIRECTORY_SEPARATOR.$file;

        $enKeys = flattenKeys($en);
        $zhKeys = flattenKeys($zh);

        $missing = array_diff($enKeys, $zhKeys);
        $extra = array_diff($zhKeys, $enKeys);

        expect($missing)->toBeEmpty("zh_CN/{$file} is missing keys: ".implode(', ', $missing));
        expect($extra)->toBeEmpty("zh_CN/{$file} has extra keys: ".implode(', ', $extra));
    })->with([
        'auth.php',
        'pagination.php',
        'passwords.php',
        'validation.php',
    ]);

    it('keeps :placeholders in zh_CN messages in sync with en', function (string $file) {
        $en = require enPath().DIRECTORY_SEPARATOR.$file;
        $zh = require zhCnPath().DIRECTORY_SEPARATOR.$file;

        $pair = function (array $en, array $zh, string $prefix = '') use (&$pair, $file): void {
            foreach ($en as $key => $value) {
                $path = $prefix === '' ? (string) $key : $prefix.'.'.(string) $key;

                if (is_array($value)) {
                    $pair($value, $zh[$key] ?? [], $path);

                    continue;
                }

                $zhValue = $zh[$key] ?? null;

                if (! is_string($zhValue)) {
                    continue;
                }

                preg_match_all('/:[a-zA-Z0-9_]+/', (string) $value, $enPlaceholders);
                preg_match_all('/:[a-zA-Z0-9_]+/', $zhValue, $zhPlaceholders);

                sort($enPlaceholders[0]);
                sort($zhPlaceholders[0]);

                expect($zhPlaceholders[0])
                    ->toBe($enPlaceholders[0], "zh_CN/{$file} placeholder mismatch at {$path}");
            }
        };

        $pair($en, $zh);
    })->with([
        'auth.php',
        'pagination.php',
        'passwords.php',
        'validation.php',
    ]);
});
