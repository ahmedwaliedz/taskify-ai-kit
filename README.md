# 🚀 TASKIFY AI-Kit (v1.2)

![Laravel](https://img.shields.io/badge/Laravel-10|11|12-FF2D20?style=flat&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=flat&logo=php)
![License](https://img.shields.io/badge/License-MIT-blue.svg)
![Workflow](https://img.shields.io/badge/Workflow-Spec→Closure-4CAF50)
![AI](https://img.shields.io/badge/Agent-Universal-007ACC)

<p align="center">
  <strong>A universal, `.md`-based starter kit that transforms any AI coding agent (Cursor, Claude, Copilot, Windsurf) into a disciplined, production-ready Laravel Tech Lead.</strong>
</p>

---

## 📖 What is Taskify?

**TASKIFY v1.2** replaces ad-hoc, chaotic prompting with a strict, spec-driven development lifecycle. It enforces security, architecture consistency, and long-term context efficiency through **automated phase gates** and **Zero Runtime Overhead**. 

By dropping this kit into your Laravel project, your AI IDE (like Cursor or Claude Code) instantly understands:
- Your preferred architecture (Thin controllers, Services when needed).
- Strict database rules and security conventions (Mandatory FormRequests).
- How to write tests properly (Pest default, TDD for Services).
- How to manage its own token limits (Memory Compression).

---

## ⚙️ Core Philosophy

| Principle | Implementation |
|-----------|----------------|
| **Spec-Driven** | `Spec → Clarify → Plan → Tasks → Implement → Closure` |
| **Secure by Default** | Mandatory `FormRequest`, explicit `$fillable`, zero PII logging |
| **Anti-Over-Engineering** | KISS + YAGNI. Services are only used if $\ge2$ of 4 conditions are met. |
| **Token-Efficient** | Isolated feature context, `memory.md` compressed to $\le150$ lines. |
| **Universal Compatibility** | Pure Markdown workflow. Works across all AI IDEs with Zero Runtime Overhead. |

---

## 🛠️ Installation

You can install Taskify in your project via two independent channels based on your workflow preference:

### Option A: Composer Package (Automated & Recommended for Laravel)
Installs the kit via Composer and provides an artisan command to scaffold the files. **Zero Runtime Overhead in production.**

```bash
composer require taskify/ai-kit
php artisan taskify:install
```
*(Use `php artisan taskify:install --force` to overwrite existing files).*

### Option B: Pure Markdown Kit (Zero Dependencies)
Ideal for non-Laravel projects or if you prefer a static, dependency-free approach.

```bash
npx degit taskify/ai-kit .ai/
# Or via git:
git clone --depth=1 https://github.com/ahmedwaliedz/taskify-ai-kit.git .ai/
```

---

## 🔄 The Phase Gates Workflow

Taskify enforces a rigid workflow. You interact with the AI using slash commands. **The AI is instructed to pause and await your `@approve` before proceeding to the next phase.**

| Phase | Command | Inputs | Outputs | Continuation Condition |
|-------|---------|--------|---------|------------------------|
| **1. Specification** | `/specify` | Initial idea description | `spec.md` | `@approve` |
| **2. Clarification** | `/clarify` | `spec.md` | Updated `spec.md` + `clarifications.md` | `@resolved` |
| **3. Planning** | `/plan` | Approved `spec.md` | `plan.md` + Git branch | `@approve` |
| **4. Task Breakdown**| `/tasks` | Approved `plan.md` | `tasks.md` (TDD order) | `@approve` |
| **5. Implementation**| `/implement` | Approved `tasks.md` | Code + Tests + Commits | Auto-repeat |
| **6. Closure** | `/closure` | All tasks done | Memory compression + Summary | ✅ Feature ready |

---

## 🧠 Memory Management & Token Efficiency

AI context windows fill up quickly. Taskify solves this with local memory management:

- **Isolated Context**: Each feature lives in its own folder (e.g., `features/user-auth/`).
- **`memory.md` Limits**: The AI tracks its active tasks and blockers in `memory.md`.
- **Auto-Compression**: When `memory.md` exceeds 150 lines, the `/compress-memory` skill is triggered. It discards old logs and completed task details, keeping only the Project Metadata, Active Blockers, and Architecture Decisions.

---

## 🔌 MCP (Model Context Protocol) Integrations

Taskify v1.2 natively supports secure, **interactive** MCP tool execution. Tools are never run blindly; the AI must ask for your permission.

**Supported Tools:**
1. **`context7`**: Fetches up-to-date documentation to prevent hallucination (Trigger: `/index-codebase`).
2. **`playwright-mcp`**: Executes E2E tests (Trigger: `/e2e-test`).
3. **`git-mcp-server`**: Safe local Git operations (branching, committing).
4. **`github-mcp-server`**: PR & Issue management.

**Configuration:**
MCP features are configured in `config/taskify.php`. You can enable/disable tools via your `.env` file:
```env
TASKIFY_MCP_CONTEXT7=false
TASKIFY_MCP_PLAYWRIGHT=false
TASKIFY_MCP_GIT=true
TASKIFY_MCP_GITHUB=false
```

---

## 📂 What's Included? (Directory Structure)

After installation, the following structure is generated in your project root:

```text
.ai/                            # The AI's brain (Do not modify unless customizing)
├── README.md                   # Kit map
├── CHANGELOG.md                # Version history
├── mcp-integrations.md         # Safe execution rules for external tools
├── rules/                      # Core architectural rules
│   ├── constitution.md         # Strict rules (Security, Architecture, Testing)
│   ├── database.md             # DB, factories, and migrations rules
│   ├── api-conventions.md      # API standards and formatting
│   ├── token-protocol.md       # Memory limit and context rules
│   └── version-adaptation.md   # Laravel 10 vs 11 vs 12 syntax adaptation
├── skills/                     # The commands you use
│   ├── specify.md              # /specify
│   ├── clarify.md              # /clarify
│   ├── plan.md                 # /plan
│   ├── tasks.md                # /tasks
│   ├── implement.md            # /implement
│   ├── closure.md              # /closure
│   ├── compress-memory.md      # Auto-triggered memory compression
│   └── index-codebase.md       # Context7 integration
└── templates/                  # Stubs used to generate the feature files

features/                       # Where your active work lives
└── _example_/                  # Example feature demonstrating the output format
    ├── spec.md                 
    ├── plan.md                 
    ├── tasks.md                
    ├── memory.md               
    └── clarifications.md       

PROJECT_CONTEXT.md              # A high-level map of all features and core decisions
```

---

## 🤝 IDE Compatibility & Setup

Taskify is universal but integrates slightly differently depending on your IDE:

- **Cursor**: The AI automatically reads `.ai/` files if referenced in `.cursorrules` or `.cursor/rules/`.
- **Claude Code**: The AI reads the markdown instructions directly from the terminal context.
- **Windsurf**: Add rules to `.windsurfrules` pointing to the `.ai/` directory.
- **GitHub Copilot**: Reference the `.ai/` templates in your `.github/copilot-instructions.md`.

## 🚀 Quick Start (First 5 Minutes)
```bash
# 1. Install in Laravel project
composer require taskify/ai-kit
php artisan taskify:install

# 2. Create first feature
mkdir -p features/user-auth
cp .ai/templates/spec.md features/user-auth/spec.md

# 3. Start with AI Agent
/specify "I need user authentication with Laravel Sanctum"
```

## 🤝 IDE Setup Guide

| IDE | Configuration | Notes |
|-----|---------------|-------|
| **Cursor** | `.cursor/rules/taskify.mdc` → `@include .ai/**/*.md` | Native slash commands |
| **Claude Code** | `.claude/commands/` → reference `.ai/skills/` | Direct chat invocation |
| **Windsurf** | `.windsurfrules` → rules: `.ai/rules/*.md` | Prompt-based triggers |
| **Copilot** | `.github/copilot-instructions.md` → link `.ai/` | Contextual chat only |

## 📦 What Happens After Installation?

- ✅ Copies `.ai/` (22 workflow files) to project root
- ✅ Scaffolds `features/_example_/` as reference
- ✅ Publishes `PROJECT_CONTEXT.md`
- ✅ **Zero Runtime Overhead** in production

## 🛠️ Troubleshooting

| Issue | Solution |
|-------|----------|
| AI ignores `.ai/` files | Ensure `.cursorrules` or `.windsurfrules` reference `.ai/` |
| `taskify:install` fails | Run inside Laravel root (must contain `artisan`) |
| `memory.md` exceeds 150 lines | Run `/compress-memory` command |

---

## 📝 License

This kit is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
