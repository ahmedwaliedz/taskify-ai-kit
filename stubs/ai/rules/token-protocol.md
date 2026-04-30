# 🧠 TOKEN PROTOCOL

## 🎯 Context Efficiency
- Load only the relevant feature directory (`features/{slug}/`).
- Read `PROJECT_CONTEXT.md` once at start of session.
- `memory.md` must be kept under 150 lines.

## 🔄 Lifecycle Context
1. Read `constitution.md` for global rules.
2. Read `version-adaptation.md` for framework syntax.
3. Verify Laravel version in `memory.md`.

## 🔌 MCP Confirmation Protocol (5 Steps)
AI **MUST** follow these steps before using MCP tools:
1. **Verify Scope**: Compare current phase with MCP `scope` (plan/clarify/closure).
2. **Print Prompt**: Display dynamic `confirmation_prompt` with filled placeholders.
3. **Wait Approval**: Block until explicit response from `required_responses`.
4. **If Rejected**: Log to `memory.md`, continue WITHOUT MCP.
5. **If Timeout**: No mention in next user message → assume `no`, log timeout.

### ⚠️ Hard Rules
- **No guessing**: Never assume `yes` for ambiguous responses.
- **Log all**: Every approval/rejection/timeout logged to `memory.md`.
- **60s timeout**: Abort and halt current phase on hang.

## 🔄 Rejection vs Timeout
| Type | Behavior |
|------|----------|
| **Rejection** | Explicit "no", "skip", "cancel" → continue without MCP |
| **Timeout** | No MCP mention in next user message → log, continue (no halt) |
| **Halt** | Only on timeout >60s (broken environment) |

## 💾 Memory Compression
Trigger `/compress-memory` when `memory.md` > 150 lines.
Preserve: Active Tasks, Blockers, Last 3 Architecture Decisions, MCP Failures.
Discard: Completed tasks, old logs.