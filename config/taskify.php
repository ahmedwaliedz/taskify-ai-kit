<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Taskify MCP Integrations
    |--------------------------------------------------------------------------
    |
    | Section 14 of TASKIFY v1.2 Spec.
    | Safe execution protocols for Context7, Playwright, Git, and GitHub MCPs.
    |
    */

    'mcp' => [
        'context7' => [
            'enabled' => env('TASKIFY_MCP_CONTEXT7', false),
            'trigger' => '/index-codebase',
            'scope' => ['plan', 'clarify'],
            'confirmation_prompt' => '🔍 Found {count} dependencies without local docs cache. Fetch latest docs via context7? (y/N): ',
        ],
        'playwright' => [
            'enabled' => env('TASKIFY_MCP_PLAYWRIGHT', false),
            'trigger' => '/e2e-test',
            'scope' => ['closure'],
            'confirmation_prompt' => '🎭 Ready to run E2E tests for AC-{x} via Playwright. Execute now? (y/N): ',
        ],
        'git' => [
            'enabled' => env('TASKIFY_MCP_GIT', true),
            'trigger' => 'auto',
            'scope' => ['plan', 'implement', 'closure'],
            'confirmation_prompt' => '🔧 Git action detected: `{action}` on branch `{branch}`. Proceed? (y/N): ',
        ],
        'github' => [
            'enabled' => env('TASKIFY_MCP_GITHUB', false),
            'trigger' => 'manual',
            'scope' => ['plan', 'closure'],
            'confirmation_prompt' => '🐙 GitHub action: `{action}` on repo `{repo}`. Proceed? (y/N): ',
        ],
        'confirmation_protocol' => [
            'required_responses' => ['y', 'yes', 'نعم', 'confirm', 'proceed', 'أيوة', 'تمام', 'موافق', 'نفّذ'],
            'log_rejection' => true,
            'escalate_after_rejections' => 3,
        ],
    ],

];
