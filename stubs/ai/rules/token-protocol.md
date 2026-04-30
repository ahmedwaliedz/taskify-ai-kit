# 🧠 TOKEN PROTOCOL

## 🎯 Context Efficiency
- Load only the relevant feature directory (`features/{slug}/`).
- Read `PROJECT_CONTEXT.md` once at start of session.
- `memory.md` must be kept under 150 lines.

## 🔄 Lifecycle Context
1. Read `constitution.md` for global rules.
2. Read `version-adaptation.md` for framework syntax.
3. Verify Laravel version in `memory.md`.

## 🔌 MCP Confirmation Protocol
AI **MUST** follow these steps before using MCP tools:
1. Compare task with MCP `scope`.
2. Print `confirmation_prompt`.
3. Wait for approval.
4. Log outcome to `memory.md`.

## 💾 Memory Compression
Trigger `/compress-memory` when `memory.md` > 150 lines.
Preserve: Active Tasks, Blockers, Last 3 Architecture Decisions.
Discard: Completed tasks, old logs.
