# 📋 TASKS: {Feature Name}

## 🔄 State Machine
```
todo → in_progress → done
                ↓
              blocked
```
| State | Meaning |
|-------|---------|
| `todo` | Pending execution |
| `in_progress` | Currently being worked on |
| `done` | Completed and tested |
| `blocked` | Waiting on dependency or clarification |

## 🔗 Traceability Map
| Task ID | Description | AC Link | State |
|---------|-------------|---------|-------|
| T-001 | Setup migration for `{table}` | [🔗 AC-1] | todo |
| T-002 | Create `{Model}` with `$fillable` | [🔗 AC-1] | todo |
| T-003 | Implement `FormRequest` validation | [🔗 AC-2] | todo |
| T-004 | Create Controller method and API Resource | [🔗 AC-2] | todo |
| T-005 | Add Pest tests for {scenario} | [🔗 AC-3] | todo |

## 🔀 Dependencies & Parallel Execution
| Task ID | Depends On | [P] Parallel With |
|---------|------------|-------------------|
| T-002 | T-001 | - |
| T-003 | T-002 | - |
| T-004 | T-003 | - |
| T-005 | - | [P] T-004 |

> **[P]**: Can be executed in parallel with listed task(s) if both are unblocked.

## 🧪 Test Order (TDD)
1. **Unit**: {Service/Model} → `T-005`
2. **Feature**: {Controller/API} → `T-005`

## 📋 Implementation Template
- [ ] **T-XXX**: {Description} [🔗 AC-X] [blocked: T-YYY]

---
*Each task must be atomic (≤30 lines), traceable (linked to AC-X), and independently testable.*