# 🔌 MCP Integration & Interactive Confirmation Protocol

## 📋 Verified Tools
| Tool | Source | Purpose |
|------|--------|---------|
| `context7` | upstash/context7 | Fetch up-to-date library docs |
| `playwright` | microsoft/playwright-mcp | Browser automation for E2E |
| `git` | github/git-mcp-server | Safe Git operations |
| `github` | github/github-mcp-server | PR/Issue management |

## 🔐 Confirmation Protocol (5 Steps)
AI **MUST** follow these steps before using MCP tools:
1. **Verify Scope**: Compare current phase with MCP `scope` (e.g., plan, clarify, closure).
2. **Print Prompt**: Display dynamic `confirmation_prompt` with filled placeholders.
3. **Wait Approval**: Block until explicit response from `required_responses` list.
4. **If Rejected**: Log to `memory.md`, continue workflow WITHOUT MCP.
5. **If Timeout**: No mention in next user message → assume `no`, log timeout.

## 🚫 Rejection vs Timeout Distinction
| Type | Definition | Action |
|------|------------|--------|
| **Rejection** | Explicit: "no", "skip", "cancel", or non-approval | Log to `memory.md`, continue WITHOUT MCP |
| **Timeout** | No MCP mention in next user message | Log timeout, continue without MCP (does NOT trigger disable) |
| **Counting** | Only explicit rejections count toward 3-rejection threshold | Log but do NOT suggest disable on timeout |

## ⏱️ MCP Timeout & Fallback Protocol (STRICT)
If any MCP tool **hangs, fails to respond within 60 seconds, or enters error loop**:
1. **Abort** tool execution immediately. DO NOT auto-retry.
2. **Log** to `memory.md` → section `## MCP Failures` with timestamp + tool + error type.
3. **Halt** current phase (unlike rejection which continues without MCP).
4. **Print**: `⚠️ MCP [{tool}] failed. Workflow halted. Run @resume after fix or @skip-mcp to continue.`
5. **Distinguish**: timeout = broken environment (halt), rejection = user choice (continue).

## 📊 Logging Template (memory.md)
```md
🔌 MCP Usage Log
| Tool | Triggered | User Response | Output File | Timestamp |
|------|-----------|--------------|-------------|-----------|
| context7 | /index-codebase | yes | .ai/context7-index.md | 2026-04-30 14:22 |
| playwright | /e2e-test | no | - | 2026-04-30 14:25 |

## MCP Failures
| Tool | Error Type | Timestamp | Resolution |
|------|------------|-----------|------------|
| context7 | timeout | 2026-04-30 15:00 | Pending |
```

## 🛡️ Hard Rules
- **No execution without explicit confirmation** — never assume `yes`.
- **After 3 consecutive rejections** → suggest temporary disable in `memory.md`.
- **60-second hard limit** — abort and halt on timeout.
- **Scope validation** — tool runs only if current phase matches defined scope.

## 📍 Configuration (config/taskify.php)
```php
'mcp' => [
    'context7' => [
        'enabled' => env('TASKIFY_MCP_CONTEXT7', false),
        'trigger' => '/index-codebase',
        'scope' => ['plan', 'clarify'],
        'confirmation_prompt' => "🔍 Found {count} dependencies. Fetch docs via context7? (y/N): ",
    ],
    'playwright' => [
        'enabled' => env('TASKIFY_MCP_PLAYWRIGHT', false),
        'trigger' => '/e2e-test',
        'scope' => ['closure'],
        'confirmation_prompt' => "🎭 Ready for E2E tests. Execute via Playwright? (y/N): ",
    ],
    'confirmation_protocol' => [
        'required_responses' => ['y', 'yes', 'نعم', 'confirm', 'proceed', 'أيوة', 'تمام', 'موافق', 'نفّذ'],
        'log_rejection' => true,
        'escalate_after_rejections' => 3,
    ],
],
```