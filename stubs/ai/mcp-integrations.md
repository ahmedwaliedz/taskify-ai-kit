# 🔌 MCP Safe Execution Protocol

This protocol governs the use of Model Context Protocol (MCP) tools: `context7`, `playwright`, `git`, and `github`.

## 🛡️ Core Rules
1. **Approval First**: AI MUST print the `confirmation_prompt` and wait for `required_responses`.
2. **Scope Validation**: Tools only run if the current phase matches their defined `scope`.
3. **Explicit Rejection**: If user says "no", log to `memory.md` and continue without the tool.
4. **Timeout Protocol**: If a tool hangs (60s), abort and halt current phase. Log failure.

## 📋 Verified Tools
- **context7**: Fetch library docs.
- **playwright**: Browser E2E testing.
- **git**: Local branch/commit management.
- **github**: PR and issue management.

## ⏸️ Confirmation Template
> 🔧 Git action detected: `git checkout -b feat/task` on branch `main`. Proceed? (y/N)

Wait for: `y`, `yes`, `نعم`, `confirm`, etc.
