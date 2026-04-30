<?php

namespace Taskify\AIKit\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallTaskifyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'taskify:install {--force : Overwrite existing files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scaffold Taskify AI Kit structure (.ai/, features/, PROJECT_CONTEXT.md)';

    protected bool $forceOverwrite = false;

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // ✅ TASKIFY v1.2: Validate Laravel Project Root
        if (! File::exists(base_path('artisan'))) {
            $this->error('❌ Taskify must be installed in a Laravel project root.');
            $this->info('💡 Error: artisan file not found. Run this command from your Laravel project directory.');

            return Command::FAILURE;
        }

        // ✅ TASKIFY v1.2: Check for existing .ai/ directory
        if (File::exists(base_path('.ai'))) {
            if ($this->option('force')) {
                $this->forceOverwrite = true;
            } elseif (! $this->confirm('⚠️  The .ai/ directory already exists. Overwrite existing files?', false)) {
                $this->info('✅ Installation cancelled. Existing files preserved.');

                return Command::SUCCESS;
            } else {
                $this->forceOverwrite = true;
            }
        } else {
            $this->forceOverwrite = true;
        }

        $this->info('🚀 Initializing Taskify AI Kit v1.2...');

        $this->setupAILayer();
        $this->setupProjectContext();
        $this->setupFeaturesDirectory();
        $this->setupConfig();

        $this->newLine();
        $this->info('✅ TASKIFY v1.2 installed successfully!');
        $this->newLine();
        $this->info('📁 Created:');
        $this->line('   • .ai/ (22 workflow files)');
        $this->line('   • features/_example_/ (reference implementation)');
        $this->line('   • PROJECT_CONTEXT.md (cross-feature tracker)');
        $this->newLine();
        $this->info('🚀 Next Steps:');
        $this->line('   1. Open features/_example_/spec.md');
        $this->line('   2. Modify it for your first feature');
        $this->line('   3. Run: /specify "your feature description"');
        $this->newLine();

        return Command::SUCCESS;
    }

    protected function setupAILayer(): void
    {
        $target = base_path('.ai');
        $this->copyDirectory(__DIR__.'/../../stubs/ai', $target, 'AI Layer (.ai/)');
    }

    protected function setupProjectContext(): void
    {
        $target = base_path('PROJECT_CONTEXT.md');
        $this->copyFile(__DIR__.'/../../stubs/PROJECT_CONTEXT.md', $target, 'Project Context');
    }

    protected function setupFeaturesDirectory(): void
    {
        $target = base_path('features/_example_');
        $this->copyDirectory(__DIR__.'/../../stubs/features/_example_', $target, 'Example Feature');
    }

    protected function setupConfig(): void
    {
        $target = config_path('taskify.php');
        $this->copyFile(__DIR__.'/../../config/taskify.php', $target, 'Configuration');
    }

    protected function copyDirectory(string $from, string $to, string $label): void
    {
        if (File::exists($to) && ! $this->forceOverwrite) {
            $this->warn("⮕ {$label} already exists. Use --force to overwrite.");

            return;
        }

        if (File::exists($to)) {
            File::deleteDirectory($to);
        }

        File::ensureDirectoryExists(dirname($to));
        File::copyDirectory($from, $to);
        $this->line("⮕ {$label} <info>created</info>.");
    }

    protected function copyFile(string $from, string $to, string $label): void
    {
        if (File::exists($to) && ! $this->forceOverwrite) {
            $this->warn("⮕ {$label} already exists. Use --force to overwrite.");

            return;
        }

        File::ensureDirectoryExists(dirname($to));
        File::copy($from, $to);
        $this->line("⮕ {$label} <info>created</info>.");
    }
}
