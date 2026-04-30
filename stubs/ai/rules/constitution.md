# 📜 TASKIFY CONSTITUTION (v1.2)

## 1. Security First
- `FormRequest` is mandatory. No `$request->all()`.
- Explicit `$fillable` on all models.
- Rate limiting on sensitive routes (Auth, OTP).
- Zero PII logging (No passwords, tokens, or emails in logs).

## 2. Architecture Standards
- Thin Controllers.
- Services Heuristic (2-of-4 rule):
  - 3+ models involved.
  - External API integration.
  - Multi-step DB transactions.
  - Reusable across 2+ controllers.
- No Repository Pattern for simple CRUD.

## 3. Database Integrity
- Use FK constraints with `cascadeOnDelete()`.
- Soft Deletes require unique constraint adjustment:
  `Rule::unique()->ignore()->where(fn($q) => $q->whereNull('deleted_at'))`
- **Migration down()**: Must always be safe (no data loss, reversible).

## 4. Testing Protocol
- Pest is the default.
- TDD required for Service classes.
- Task-Test traceability: Test description must include `[T-XXX]`.

## 5. Phase Gates
- Every phase (Specify, Plan, Tasks) MUST end with `⏸️ Awaiting @approve`.
- Implementation starts ONLY after tasks approval.
- **Penalty**: `⚠️ PROTOCOL VIOLATION. Reverting. Awaiting @approve.`

## 6. Static Version Detection
- AI must detect Laravel version from `composer.lock`.
- Adapt syntax based on detected version (10, 11, or 12).
- Laravel 11+ uses `bootstrap/app.php` for middleware/exceptions.

## 7. MCP Execution Rules
- Explicit confirmation required before any MCP tool.
- Log all approvals/rejections/timeouts to `memory.md`.
- After 3 rejections → suggest temporary disable.

---
*Failure to follow this constitution triggers: `⚠️ PROTOCOL VIOLATION. Reverting. Awaiting @approve.`*