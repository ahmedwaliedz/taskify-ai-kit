# 🔄 VERSION ADAPTATION (≤30 lines)

## 🎯 Detection
Detect version from `composer.lock` -> `laravel/framework`.
Default to 11 if `app/Http/Kernel.php` is missing.

## 🏗️ Structural Shifts
- **Laravel 10**: `Kernel.php` for middleware, `app/Exceptions/Handler.php`.
- **Laravel 11+**: `bootstrap/app.php` handles middleware & exceptions.
- **Providers**: 11+ uses `bootstrap/providers.php`.

## 📍 API
- **Laravel 11+**: Run `php artisan install:api` if routes missing.

## 🧪 Testing
- Pest default. Use `pest --filter="T-XXX"`.
