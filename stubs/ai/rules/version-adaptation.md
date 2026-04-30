# 🔄 VERSION ADAPTATION (≤30 lines)

## 🎯 Static Detection (Zero Runtime Overhead)
Reads `composer.lock` → extracts `laravel/framework` → determines major (10/11/12).

## 🔄 Fallback Detection Chain (4 Levels)
1. **Primary**: Read `composer.lock` → extract exact version.
2. **Secondary**: If `composer.lock` missing → read `composer.json` constraint (e.g., `^11.0` → assume 11.x).
3. **Tertiary**: Both missing/unparseable → halt, ask: `⚠️ Laravel version not detected. Specify (10/11/12):`
4. **Final**: If `app/Http/Kernel.php` missing → assume Laravel 11+.

## 💾 Detection Caching Protocol
- **First detection**: Read `composer.lock` → cache in `memory.md`:
  ```
  Laravel Version: 11.x (detected: 2026-04-30 from composer.lock)
  ```
- **Subsequent reads**: Read from `memory.md` (no re-parsing).
- **Re-detection triggers**: Manual `@detect`, missing metadata, or user mentions composer.json change.

## 🏗️ Laravel 11+ Structural Adaptation
- `app/Http/Kernel.php` → `bootstrap/app.php` via `withMiddleware()`.
- `app/Console/Kernel.php` → `routes/console.php`.
- API routes → requires `php artisan install:api`.
- Providers → registered in `bootstrap/providers.php`.

## 📍 File Limit
Strict ≤30 lines. Loaded once during Bootstrap phase.