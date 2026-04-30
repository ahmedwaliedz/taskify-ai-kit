# 🗜️ SKILL: /compress-memory

## Purpose
Reduce `memory.md` size to stay within token limits.

## Workflow
1. Read current `memory.md`.
2. Keep:
   - Project Metadata (Laravel version).
   - Active Blockers.
   - Current Task ID.
   - Last 3 Architecture Decisions.
   - MCP Failures section.
3. Remove:
   - Resolved tasks.
   - Code snippets.
   - Old logs.
4. Apply HTML compression directive header.

## Limit
Target: ≤150 lines.
