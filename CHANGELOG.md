# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.2.0] - 2026-08-01

### Added
- `lang/zh_CN.json` with 43 JSON translation keys covering Laravel's framework views: error pages (419/403/404/500/503), mail templates (password reset, email verification), and pagination strings.
- `LangServiceProvider` now publishes `zh_CN.json` to `lang/zh_CN.json` alongside the existing PHP files.
- Test coverage extended: JSON key parity (against the caouecs/Laravel-lang reference set), JSON placeholder sync, and JSON translation resolution after `vendor:publish`.

## [0.1.0] - 2026-08-01

### Added
- Project skeleton: `LangServiceProvider` with the `lang.zh-CN` publish tag.
- Simplified Chinese (zh_CN) translations for Laravel's built-in PHP language files: `auth`, `pagination`, `passwords`, `validation`.
- Pest test suite covering file structure, key parity with Laravel's `en` source, placeholder sync, and end-to-end `vendor:publish` resolution.
