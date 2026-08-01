# Contributing

Thank you for considering contributing to `fengz/laravel-lang-zh-cn`! This document describes the local workflow.

## Development Setup

```bash
git clone <repo-url>
cd laravel-lang-zh-cn
composer install
```

Requires **PHP 8.5+** and Composer.

## Common Commands

| Command | Description |
|---------|-------------|
| `composer test` | Run the Pest test suite. |
| `composer test:coverage` | Run tests with coverage. |
| `composer format` | Format code with Laravel Pint (auto-fix). |
| `composer analyse` | Run PHPStan (level: max) static analysis. |

Before opening a pull request, all three should pass:

```bash
composer format
composer analyse
composer test
```

## Workflow

1. **Open an issue first** for new features or breaking changes, to discuss direction.
2. Fork the repository and create a feature branch from `main`.
3. Make your changes. Keep commits focused; one logical change per commit.
4. Add or update tests covering your change.
5. Run `composer format && composer analyse && composer test` locally.
6. Update `CHANGELOG.md` under `### [Unreleased]`.
7. Open a pull request describing **what** changed and **why**.

## Code Style

- `declare(strict_types=1)` in every PHP file.
- Follow Laravel conventions; Pint enforces formatting with the Laravel preset.
- All public API methods declare parameter and return types.

## Translation Conventions

- Translation keys **must stay in lockstep with Laravel's `en` source** under `vendor/laravel/framework/src/Illuminate/Translation/lang/en/`. The key-parity test (`TranslationFilesTest`) enforces this automatically — a PR that adds or removes a key without matching `en` will fail CI.
- Placeholders like `:attribute`, `:other`, `:value`, `:min`, `:max` must be preserved verbatim. The placeholder-sync test guards this.
- Use community-established Simplified Chinese wording; prefer clarity over literal translation.
- Keep the `custom` and `attributes` arrays as Laravel ships them (empty scaffold) unless introducing package-specific additions.

## Testing Conventions

- Tests use **Pest** and run inside an Orchestra Testbench Laravel app.
- The key-parity and placeholder tests compare against the installed Laravel framework's `en` files — run `composer install` so the framework is present before testing.
- Name tests as full sentences describing behavior: `it('has every key that the Laravel en source defines')`.

## Pull Request Checklist

- [ ] Tests added/updated and passing
- [ ] `composer analyse` passes (no new PHPStan errors)
- [ ] `composer format` applied (no formatting diff)
- [ ] `CHANGELOG.md` updated
- [ ] Documentation (README) updated if user-facing behavior changed
