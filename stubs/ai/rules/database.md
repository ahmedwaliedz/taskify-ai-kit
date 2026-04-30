# 🗄️ DATABASE RULES

## 🏗️ Schema Design
- Use `bigIncremental` IDs (Laravel default).
- Foreign Keys: `->constrained()->cascadeOnDelete()->cascadeOnUpdate()`.
- Indexes: Single column via `->index()`. Composite indexes must be justified with comments.
- JSON Columns: Use for metadata only, avoid for primary data.

## 🔄 Transactions
- Mandatory for any operation touching 2+ tables.
- Use `DB::transaction(fn() => ...)` for safety.

## 🧪 Factories & Seeders
- Use `->for()` and `->has()` for relationships.
- Faker:
  - `Faker::realText(50)` for content.
  - `Faker::sentence(10)` for titles.
  - Locale: `ar_EG` for realistic localized data.
- Avoid "Test User 1" placeholders.

## 🛡️ Migration Safety
- `down()` method must be functional and safe.
- Never use `Schema::dropIfExists()` in production migrations unless strictly requested.
