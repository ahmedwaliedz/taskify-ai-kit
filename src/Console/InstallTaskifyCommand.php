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

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->info('🚀 Initializing Taskify AI Kit v1.2...');

        $this->setupAILayer();
        $this->setupProjectContext();
        $this->setupFeaturesDirectory();
        $this->setupConfig();

        $this->info('✅ Taskify AI Kit structure is ready.');
        $this->comment('Next: Run "/specify" to start your first feature.');
    }

    protected function setupAILayer(): void
    {
        $target = base_path('.ai');
        $this->copyDirectory(__DIR__ . '/../../stubs/ai', $target, 'AI Layer (.ai/)');
    }

    protected function setupProjectContext(): void
    {
        $target = base_path('PROJECT_CONTEXT.md');
        $this->copyFile(__DIR__ . '/../../stubs/PROJECT_CONTEXT.md', $target, 'Project Context');
    }

    protected function setupFeaturesDirectory(): void
    {
        $target = base_path('features/_example_');
        $this->copyDirectory(__DIR__ . '/../../stubs/features/_example_', $target, 'Example Feature');
    }

    protected function setupConfig(): void
    {
        $target = config_path('taskify.php');
        $this->copyFile(__DIR__ . '/../../config/taskify.php', $target, 'Configuration');
    }

    protected function copyDirectory(string $from, string $to, string $label): void
    {
        if (File::exists($to) && !$this->option('force')) {
            $this->warn("⮕ {$label} already exists. Use --force to overwrite.");
            return;
        }

        File::ensureDirectoryExists(dirname($to));
        File::copyDirectory($from, $to);
        $this->line("⮕ {$label} <info>created</info>.");
    }

    protected function copyFile(string $from, string $to, string $label): void
    {
        if (File::exists($to) && !$this->option('force')) {
            $this->warn("⮕ {$label} already exists. Use --force to overwrite.");
            return;
        }

        File::ensureDirectoryExists(dirname($to));
        File::copy($from, $to);
        $this->line("⮕ {$label} <info>created</info>.");
    }
}
