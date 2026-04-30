# 📋 SKILL: /tasks

## Purpose
Break the approved plan into atomic, traceable tasks.

## Workflow
1. Review `plan.md`.
2. Generate `tasks.md`.
3. Each task MUST be:
   - **Atomic** (one responsibility, ≤30 lines).
   - **Traceable** (linked to `AC-X` via 🔗).
   - **TDD-ready** (includes test order).
   - **State-aware** (todo → in_progress → done|blocked).
4. Assign IDs: `T-001`, `T-002`, etc.
5. Document **Dependencies**: which tasks must complete first.
6. Mark **[P]** for tasks that can run in parallel.

## Output Format
```markdown
## 🔄 State Machine
todo → in_progress → done|blocked

## 🔗 Traceability Map
| Task ID | Description | AC Link | State |
|---------|-------------|---------|-------|
| T-001 | Setup migration | [🔗 AC-1] | todo |

## 🔀 Dependencies & Parallel
| Task ID | Depends On | [P] Parallel With |
|---------|------------|------------------|
| T-002 | T-001 | - |

## 🧪 Test Order (TDD)
1. Unit: {Service/Model}
2. Feature: {Controller/API}
```

## Output
`⏸️ Awaiting @approve`