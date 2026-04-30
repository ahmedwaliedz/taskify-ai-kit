# 📜 TASKIFY v1.2 – Development Conversation & Specification Log

> **Version:** 1.2  
> **Date:** 2026-04-30  
> **Trust Recovery Release:** Fixes 6 unresolved defects + restores 2 lost sections from v1.0→v1.1 transition.  
> **Verification:** All claims backed by reproducible grep evidence (see VERIFICATION-CHECKLIST-v1.2.md).

---

## 1. Project Overview
**TASKIFY v1.2** is a universal, `.md`-based starter kit that transforms any AI coding agent (Cursor, Claude, Copilot, Windsurf) into a disciplined, production-ready Laravel Tech Lead.  
It replaces ad-hoc prompting with a strict, spec-driven lifecycle, enforcing security, architecture consistency, and long-term context efficiency through automated phase gates and Zero Runtime Overhead.

---

## ⚙️ 2. Core Philosophy & Stack
| Principle | Implementation |
|-----------|----------------|
| **Spec-Driven** | `Spec → Clarify → Plan → Tasks → Implement → Closure` |
| **Secure by Default** | Mandatory `FormRequest`, explicit `$fillable`, rate limiting, zero PII logging |
| **Anti-Over-Engineering** | KISS + YAGNI. Services only if ≥2 of 4 conditions met. No Repository for simple CRUD |
| **Token-Efficient** | Isolated feature context, `memory.md` ≤150 lines, single-load rule parsing |
| **Universal Compatibility** | Pure Markdown workflow. Zero Runtime Overhead. Works across all AI IDEs |

**Technical Stack:**
- **Framework:** Laravel 10.x / 11.x / 12.x (Statically Detected)
- **PHP:** 8.2+
- **Admin UI:** Livewire 3 + jQuery AJAX (Hybrid)
- **Tables/Exports:** 100% Custom AJAX + API Resources (No Yajra/DataTables)
- **API Auth:** Sanctum (Token mode)
- **API Versioning:** `/api/v1/` (Mandatory)
- **Pagination:** Laravel default (`data`, `links`, `meta`)
- **Testing:** Pest (default) + PHPUnit (justified exceptions)
- **Git Branching:** `feat/{feature-slug}` per feature

---

## 📂 3. Architecture & File Structure

### File Count Breakdown
| Location | Count |
|----------|-------|
| Root (.ai/) | 3 |
| rules/ | 5 |
| skills/ | 8 |
| templates/ | 6 |
| **Total** | **22** |

> **Note:** v1.2 added `mcp-integrations.md` and `CHANGELOG.md` to the root, expanding from v1.0's 21 files to 22.

### `.ai/` Directory (22 Files)
```
.ai/
├── README.md                       ← Kit map + memory management
├── CHANGELOG.md                    ← Version history + breaking changes log
├── mcp-integrations.md             ← Safe execution protocol for MCPs
├── rules/
│   ├── constitution.md             ← ≤200 lines (Security, Architecture, Testing, Checkpoints)
│   ├── database.md                 ← Schema, Indexes, Transactions, Factories
│   ├── api-conventions.md          ← Versioning, Resources, Validation, List Standard
│   ├── token-protocol.md           ← Context loading, Memory compression, MCP confirmation
│   └── version-adaptation.md       ← Output adaptation per detected Laravel version
├── skills/
│   ├── specify.md                  ← request → spec.md → @approve
│   ├── clarify.md                  ← spec → clarifications.md → @resolved
│   ├── plan.md                     ← spec → plan.md + git branch → @approve
│   ├── tasks.md                    ← plan → tasks.md (Dependencies + TDD order) → @approve
│   ├── implement.md                ← tasks → code + tests + commit → repeat
│   ├── closure.md                  ← Final verification, testing, compression → @approve
│   ├── compress-memory.md          ← Memory compression protocol (≤150 lines)
│   └── index-codebase.md           ← Context7 integration protocol
├── templates/
│   ├── spec.md                     ← User Story + Gherkin ACs + NFRs + Scope
│   ├── plan.md                     ← Schema + Contracts + Service Boundaries
│   ├── tasks.md                    ← State Machine + Traceability Map
│   ├── memory.md                   ← Mandatory compression template ≤150 lines + HTML compression directive header
│   ├── clarifications.md            ← Clarification template (max 5 questions)
│   └── PROJECT_CONTEXT.md          ← Cross-feature integration tracker
└── mcp-integrations.md             ← Safe execution protocol for context7 & playwright
```

### Standard Feature Structure
```
features/{feature-slug}/
├── spec.md              ← Business requirements + Gherkin + NFR
├── clarifications.md    ← Critical questions + answers (Max 5)
├── plan.md              ← Schema + API Contracts + Service Decision
├── tasks.md             ← Execution list linked to 🔗 AC-X
└── memory.md            ← Decisions + Active Tasks + Blockers (≤150 lines)
```

---

## 🔄 4. Workflow & Phase Gates
| Phase | Command | Inputs | Outputs | Continuation Condition |
|-------|---------|--------|---------|------------------------|
| 0. Static Detection | (Auto) | `composer.lock` / `.json` | Detected Version → Loaded in `memory.md` | Zero Runtime Overhead |
| 1. Specification | `/specify` | Initial description | `spec.md` | `@approve` |
| 2. Clarification | `/clarify` | `spec.md` | Updated `spec.md` + `clarifications.md` | `@resolved` (all questions blocker) |
| 3. Planning | `/plan` | Approved `spec.md` | `plan.md` + `git checkout -b feat/{slug}` | `@approve` |
| 4. Task Breakdown | `/tasks` | Approved `plan.md` | `tasks.md` (Dependencies + [P] + TDD order) | `@approve` |
| 5. Implementation | `/implement` | Approved `tasks.md` | Code + Tests + Commits + Update `tasks.md`/`memory.md` | Auto-repeat until `[x]` |
| 6. Closure | `/closure` | All tasks `[x]` | Full `pest` → `pint` → compress `memory.md` → update `PROJECT_CONTEXT.md` | ✅ Feature ready |

🔒 **Hard Checkpoint Rule:**  
After each phase, AI prints only: `⏸️ Awaiting @approve`.  
Generating code before approval triggers: `⚠️ PROTOCOL VIOLATION. Reverting. Awaiting @approve.`

---

## 🛡️ 5. Technical Rules & Conventions

### 🔒 Security
- `FormRequest` mandatory, `$request->all()` is forbidden
- Explicit `$fillable`, Authorization on every route param
- Rate limiting on Auth/OTP/Password Reset
- No logging: passwords / tokens / PII

### 🏗️ Architecture
- Thin Controllers. Services only if 2 of 4: (3+ models, External API, Multi-step transaction, Reusable 2+ controllers)
- No Repository Pattern for simple CRUD
- Migration `down()` must always be safe

### 🗄️ Database
- FKs: `->constrained()->cascadeOnDelete()->cascadeOnUpdate()`
- Indexes: Laravel defaults only. Composite inline commented.
- Soft Delete + Unique: `Rule::unique()->ignore()->where(fn($q) => $q->whereNull('deleted_at'))`
- **Factories:**
  - Use `->for()` / `->has()` for relationships
  - For realistic text: `Faker::realText(50)` (50+ characters minimum) or `Faker::sentence(10)` (10 words)
  - Avoid sequential placeholder data: "Test User 1", "Test User 2"
  - Use locale-aware faker for real-world data: `Faker\Factory::create('ar_EG')`

### 🔌 API Conventions
- Versioning: `/api/v1/` mandatory
- Response: `API Resource` mandatory, NEVER return Eloquent directly
- Validation: `per_page: integer|min:1|max:100`, `sort/dir` whitelisted
- List Standard: `->when()` for filters, `->orderBy()`, `paginate()`, eager load relations

### 🧪 Testing
- Pest default, `pest --filter="T-XXX"` during execution, full suite at `/closure`
- Strict TDD for Services only
- **Task-Test Naming Convention:**
  - Each task in `tasks.md` has format: `T-001: [Description]`
  - Each test must include task ID in description:
    ```php
    it('validates email format for AC-2 [T-005]', function () { ... });
    ```
  - Filter command: `pest --filter="T-005"`
- Never modify tests to pass. 3 failures → STOP + document in `memory.md`

---

## 🔍 6. Static Version Detection & Adaptation

**Rationale:** "Static" means the AI parses `composer.lock` directly without runtime commands or daemons. This differs from "automatic" which implies background detection.

- **Zero Runtime Overhead:** Reads `composer.lock` → extracts `laravel/framework` → determines major version (10/11/12)
- **Fallback Detection Chain:**
  1. Primary: Read `composer.lock` → extract `laravel/framework` exact version.
  2. Secondary: If `composer.lock` missing → read `composer.json` constraint 
     range (e.g., `^11.0` → assume Laravel 11.x).
  3. Tertiary: If both missing OR version unparseable → halt and ask user: 
     `⚠️ Laravel version not detected. Specify manually (10/11/12):`
  4. Final safety net: If `app/Http/Kernel.php` does NOT exist → assume 
     Laravel 11+ regardless of detection result.
- Automatically loads `.ai/rules/version-adaptation.md`
- Adapts output syntax for: Provider structure, Route/Middleware syntax, Migration defaults, Factory/Seeder generation
- **Laravel 11+ Structural Adaptation (Critical):**
  - `app/Http/Kernel.php` → middleware now in `bootstrap/app.php` via `withMiddleware()`
  - `app/Console/Kernel.php` → scheduler now in `routes/console.php`
  - `app/Exceptions/Handler.php` → exception handling in `bootstrap/app.php` via `withExceptions()`
  - API routes NOT present by default → requires `php artisan install:api`
  - Most default service providers removed → only `AppServiceProvider` remains
  - New providers registered in `bootstrap/providers.php` (not `config/app.php`)
  - **Detection rule:** If `app/Http/Kernel.php` does not exist → assume Laravel 11+ behavior
- Never modifies original project structure or attempts auto-upgrades
- File limit: `version-adaptation.md` ≤30 lines, loaded once during Bootstrap

### Detection Caching Protocol
1. On first `/specify` or `@detect`: AI reads `composer.lock` → extracts version
2. Result cached in `memory.md` under `## Project Metadata` section:
   ```
   Laravel Version: 11.x (detected: 2026-04-30 from composer.lock)
   ```
3. On subsequent commands: AI reads from `memory.md` (no re-parsing)
4. Re-detection triggered ONLY if:
   - User runs `@detect` manually
   - `memory.md` is missing the metadata
   - User explicitly mentions composer.json change

---

## 🔌 7. IDE Integration

TASKIFY supports multiple AI IDEs with varying capabilities:

| IDE | Method | File Location | Slash Command Support |
|-----|--------|---------------|----------------------|
| **Cursor** | `.cursor/rules/*.mdc` | `.cursor/rules/taskify-skills.mdc` | ✅ Native support |
| **Claude Code** | Slash command files | `.claude/commands/*.md` | ✅ Via command files |
| **Windsurf** | Cascade rules | `.windsurfrules` | ⚠️ Rules only — invoked via prompt mention |
| **Copilot** | Instruction file | `.github/copilot-instructions.md` | ❌ No slash commands — invoked contextually via Chat |

### Installation per IDE
- **Cursor:** Copy `.ai/` folder content to project root, create `.cursor/rules/taskify.mdc` with `*.md` references
- **Claude Code:** Create `.claude/commands/` with skill files, reference `.ai/skills/*.md`
- **Windsurf:** Add rules to `.windsurfrules`, ensure `.ai/` exists in project
- **Copilot:** Append instructions to `.github/copilot-instructions.md`

### Auto-Generation Note
The `taskify:install` command (see Section 8) automatically generates IDE-specific adapter files based on detected IDE.

---

## 📦 8. Composer Package Structure & Installation

### Package Layout
```
taskify/ai-kit/
├── composer.json
├── src/TaskifyServiceProvider.php
├── src/Console/InstallTaskifyCommand.php
├── config/taskify.php
├── stubs/ai/ (22 .md files)
├── stubs/features/_example_/
└── stubs/PROJECT_CONTEXT.md
```

### Installation Command
```bash
composer require taskify/ai-kit
php artisan taskify:install
# php artisan taskify:install --force  (to overwrite)
```

### Service Provider Behavior
- Publishes `.ai/`, `features/_example_/`, and `PROJECT_CONTEXT.md`
- Registers `taskify:install` command
- **ServiceProvider has Zero Runtime Overhead in production.** It is registered for installation only and has no runtime cost after initial scaffolding.

---

## 🔌 9. MCP Integration & Interactive Confirmation Protocol

### Verified Tools
| Tool | Source | Last Verified | Purpose |
|------|--------|---------------|---------|
| `context7` | [upstash/context7](https://github.com/upstash/context7) | 2026-04-30 | Fetch up-to-date library docs to prevent hallucination |
| `playwright-mcp` | [microsoft/playwright-mcp](https://github.com/microsoft/playwright-mcp) | 2026-04-30 | Browser automation for E2E testing |
| `git-mcp-server` | [github/git-mcp-server](https://github.com/github/git-mcp-server) | 2026-04-30 | Safe Git operations for AI |
| `github-mcp-server` | [github/github-mcp-server](https://github.com/github/github-mcp-server) | 2026-04-30 | PR/Issue management |

### Confirmation Protocol (Enforced)
Even if `enabled => true`, AI **MUST**:
1. Verify current task matches MCP `scope`
2. Print dynamic `confirmation_prompt` with filled placeholders
3. Wait for explicit approval from `required_responses` list
4. If rejected → log to `memory.md`, continue workflow without MCP
5. If no explicit approval within next user message → assume `no`, log timeout

### Rejection vs Timeout Distinction
- **Rejection:** Explicit "no", "skip", "cancel", or any non-approval response
- **Timeout:** No mention of MCP in the next user message
- **Counting Rule:** Only **explicit rejections** count toward escalation threshold
- **Timeout Behavior:** Logged but does NOT trigger disable suggestion
- **Rationale:** User may have simply forgotten or moved to another task

### MCP Timeout & Fallback Protocol (STRICT)
If any MCP tool (context7, playwright, git-mcp, github-mcp) **hangs, fails to respond within 60 seconds, or enters an error loop**:
1. **Abort tool execution immediately.** DO NOT auto-retry.
2. **Log to `memory.md`** → new section `## MCP Failures` with timestamp + tool name + error type (timeout/error-loop/connection-refused).
3. **Halt the current phase** (unlike rejection which continues without MCP).
4. Print: `⚠️ MCP [{tool}] failed. Workflow halted. Run @resume after fix or @skip-mcp to continue without it.`
5. **Distinguish from Rejection:** timeout = broken environment (halt), rejection = conscious user choice (continue without MCP).

### Logging Template (`memory.md`)
```md
🔌 MCP Usage Log
| Tool | Triggered | User Response | Output File | Timestamp |
|------|-----------|--------------|-------------|-----------|
| context7 | /index-codebase | yes | .ai/context7-index.md | 2026-04-30 14:22 |
| playwright | /e2e-test | no | - | 2026-04-30 14:25 |
```

### Hard Rules
- No MCP execution without explicit confirmation
- Never assume `yes` for ambiguous responses
- After 3 consecutive rejections → suggest temporary disable

---

## 📡 10. Distribution Channels (Pure Kit vs Composer Package)

TASKIFY is available via **two independent channels**:

### Option A: Pure Markdown Kit (Zero Dependencies)
- **Method:** Clone from Git or use `degit`
- **Installation:** 
```bash
degit taskify/ai-kit ./
# or manually
git clone --depth=1 https://github.com/taskify/ai-kit.git .ai/
```
- **What you get:** All 22 `.md` files in `.ai/` directory
- **Zero overhead:** No Composer, no ServiceProvider, no Artisan commands
- **Ideal for:** Teams preferring static, version-controlled kit

### Option B: Composer Package (Automated Installation)
- **Method:** `composer require taskify/ai-kit`
- **Installation:** `php artisan taskify:install`
- **What you get:** Scaffolded `.ai/`, `features/_example_/`, `PROJECT_CONTEXT.md`
- **Runtime:** ServiceProvider has Zero Runtime Overhead in production
- **Ideal for:** Teams wanting automatic updates and Laravel integration

**Both channels produce identical `.md` files.** Choose based on deployment preference.

### Comparison Matrix
| Feature | Pure Kit (degit) | Composer Package |
|---------|------------------|------------------|
| Dependencies | None | Composer + Laravel |
| Update mechanism | Manual git pull | `composer update` |
| Customization | Direct file edits | Stub publishing |
| CI/CD friendly | ✅ Yes | ✅ Yes |
| Cross-language compatibility | ✅ Yes (any project) | ❌ Laravel only |

---

## 📋 11. Failure Recovery Protocol

If any of the following occur during implementation:

| Failure Type | Action | Log Location |
|--------------|--------|--------------|
| **Migration Failed** | Rollback via `php artisan migrate:rollback --step=1`. Document reason in `memory.md` | `memory.md` → Blockers |
| **Test Syntax Error** | Fix test file. Allowed as single fix. If error recurs → STOP | `memory.md` → Test Errors |
| **3+ Environment Failures** (DB/Cache) | Stop immediately. Do not retry. Document as blocker | `memory.md` → Blockers |
| **Bad Git Commit** | If unpushed: `git reset --soft HEAD~1`, fix, recommit. Log in `memory.md` | `memory.md` → Git Events |
| **Security Violation Detected** | Revert entire task. Document in `memory.md` → Security Incidents | `memory.md` → Security |
| **Circular Dependency** | Refactor service boundaries. Update `plan.md`. Escalate to user | `memory.md` → Architecture Decisions |
| **Merge Conflicts** | Pause workflow. Print conflict files. Ask user for resolution. Do NOT auto-resolve | `memory.md` → Git Events |
| **`/closure` Test Failures** | Do NOT delete branch. Document failures. Allow user to fix and re-run | `memory.md` → Closure Issues |
| **Pre-existing Branch Conflict** | If `feat/{slug}` exists → ask user: reuse, rename, or abort | `memory.md` → Git Events |

**General Principle:** Document every rollback and recovery in `memory.md`. Never silently skip failures.

### Git Strategy
- **Branch Naming:** `feat/{feature-slug}` (e.g., `feat/001-categories`)
- **Creation:** Automatically at `/plan` before writing `plan.md`
- **Default Merge:** `--squash` for feature branches (clean history)
- **Override:** User can specify `--no-ff` in `plan.md` if needed

---

## 📖 12. Project Context & Memory Management

### PROJECT_CONTEXT.md
- **Soft limit:** 150 lines → Warning logged in `memory.md`
- **Hard limit:** 200 lines → Compression triggered automatically
- **Compression mechanism:**
  - Preserve: Architecture Decisions, Active Feature Statuses, Cross-Feature Constraints
  - Compress: Move closed feature details to `archive/PROJECT_CONTEXT_archive_YYYY-MM.md`
  - Trigger: Automatic during `/closure` if limit exceeded
- **Owner:** AI agent during `/closure` phase

### memory.md Limits
- **150 lines (soft):** Print warning, suggest `/compress-memory`
- **180 lines:** Auto-trigger `compress-memory.md` at next phase boundary
- **200 lines (hard):** BLOCK new phase commands until compression completes
- **Compression header (mandatory):** Every `templates/memory.md` MUST start with:
```html
<!-- AI COMPRESSION DIRECTIVE: Max 150 lines (soft) / 200 lines (hard).
     KEEP ALWAYS: Project Metadata, active blockers, current task ID, 
                  last 3 architecture decisions, MCP Failures section.
     REMOVE ON COMPRESSION: resolved tasks, completed code snippets, 
                            MCP logs from closed features.
     NEVER REMOVE: Laravel version + detection date (Project Metadata). -->
```
- **Compression preserves:** Active blockers, current task, last 3 decisions + MCP Failures section
- **Compression discards:** Resolved blockers, completed tasks, MCP logs older than current feature

---

## 📝 13. Prompting Guidelines Integration
Based on Claude Prompting Guide, TASKIFY enforces:
- ✅ Clear & specific task definitions at prompt start
- ✅ Structured output formats (tables, lists, code blocks)
- ✅ Step-by-step reasoning for complex architectural decisions
- ✅ Iterative refinement via `/clarify` phase
- ✅ Role-playing: AI acts as `Senior Laravel Tech Lead & AI Workflow Architect`
- ✅ Acknowledge uncertainty; never guess critical syntax
- ✅ Break large features into **atomic, traceable tasks**

### Atomic Task Criteria
A task is "atomic" when it satisfies ALL:
- ✅ Single responsibility (one model OR one endpoint OR one service method)
- ✅ Estimated ≤30 lines of code
- ✅ Independently testable (can pass tests in isolation)
- ✅ Linked to exactly ONE Acceptance Criterion (`AC-X`)
- ✅ Completable in one `/implement` cycle (no mid-task escalation needed)

❌ NOT atomic: "Build user authentication" (too broad)
✅ Atomic: "Create LoginRequest with email/password validation linked to AC-2"

---

## ⚙️ 14. Configuration & Environment
### `config/taskify.php` (MCP Section)
```php
'mcp' => [
    'context7' => [
        'enabled' => env('TASKIFY_MCP_CONTEXT7', false),
        'trigger' => '/index-codebase',
        'scope' => ['plan', 'clarify'],
        'confirmation_prompt' => "🔍 Found {count} dependencies without local docs cache. Fetch latest docs via context7? (y/N): ",
    ],
    'playwright' => [
        'enabled' => env('TASKIFY_MCP_PLAYWRIGHT', false),
        'trigger' => '/e2e-test',
        'scope' => ['closure'],
        'confirmation_prompt' => "🎭 Ready to run E2E tests for AC-{x} via Playwright. Execute now? (y/N): ",
    ],
    'git' => [
        'enabled' => env('TASKIFY_MCP_GIT', true),
        'trigger' => 'auto',
        'scope' => ['plan', 'implement', 'closure'],
        'confirmation_prompt' => "🔧 Git action detected: `{action}` on branch `{branch}`. Proceed? (y/N): ",
    ],
    'github' => [
        'enabled' => env('TASKIFY_MCP_GITHUB', false),
        'trigger' => 'manual',
        'scope' => ['plan', 'closure'],
        'confirmation_prompt' => "🐙 GitHub action: `{action}` on repo `{repo}`. Proceed? (y/N): ",
    ],
    'confirmation_protocol' => [
        'required_responses' => ['y', 'yes', 'نعم', 'confirm', 'proceed', 'أيوة', 'تمام', 'موافق', 'نفّذ'],
        'log_rejection' => true,
        'escalate_after_rejections' => 3,
    ],
],
```

### `.env` Integration
```env
TASKIFY_MCP_CONTEXT7=false
TASKIFY_MCP_PLAYWRIGHT=false
TASKIFY_MCP_GIT=true
TASKIFY_MCP_GITHUB=false
```

---

## 📊 15. Decision Log & Key Agreements
| Decision | Technical Rationale |
|----------|---------------------|
| 100% Custom AJAX + API Resources | Lightweight payloads, unified responses, AI-compatible output |
| Strict Phase Gates (`@approve` mandatory) | Prevents stage skipping; ensures spec-implementation alignment; reduces context-switching cost between phases. *Inspired by GitHub Spec-Kit and Claude Engineering best practices.* |
| Service Decision Heuristic (2-of-4) | Prevents over-engineering, keeps controllers thin |
| Git Branch per Feature | Context isolation, easier review, CI/CD compliance |
| `PROJECT_CONTEXT.md` | Preserves cross-feature integration without bloating context window |
| MCPs as Optional Gated Tools | Meets advanced needs while preserving Zero Runtime Overhead & Hard Checkpoints |
| Memory Compression ≤150 lines (soft) / 200 (hard) | Guarantees token efficiency across long-running projects |
| Static Version Detection | Ensures syntax accuracy across Laravel 10/11/12 without runtime commands |
| Rejection of CI Hooks & Complex Patch System (v1) | Deferred to v2.0 after validating workflow on real features |

---

## 🎯 16. Next Steps
- ✅ Architecture locked, rules clarified, workflow production-ready
- 📁 22 `.md` files + package scaffolding ready for generation
- 🔌 MCP confirmation protocol integrated into `token-protocol.md` & `config/taskify.php`
- 🎯 **Awaiting command:** `ابدأ` to generate all files in structured, copy-paste ready format.

---

*Document generated from TASKIFY v1.2 planning session. All specifications are binding for AI agent behavior until explicitly overridden via `/clarify` or `memory.md` updates.*