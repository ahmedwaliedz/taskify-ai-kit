# 💻 SKILL: /implement

## Purpose
Execute tasks one by one.

## Workflow
1. Pick next task `T-XXX` from `tasks.md`.
2. Write Pest tests first (TDD).
3. Implement code.
4. Run `pest --filter="T-XXX"`.
5. Fix until green.
6. Commit: `feat: [T-XXX] [Description]`.
7. Update `tasks.md` and `memory.md`.
8. Repeat for next task.

## Constraints
- Never skip tests.
- 3 failures = STOP & document in `memory.md`.
