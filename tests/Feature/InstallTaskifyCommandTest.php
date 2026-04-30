<?php

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Taskify\AIKit\Console\InstallTaskifyCommand;

test('stubs/ai contains 22 files as per specification', function () {
    $aiPath = __DIR__.'/../../stubs/ai';

    $files = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($aiPath, RecursiveDirectoryIterator::SKIP_DOTS)
    );

    $mdFiles = [];
    foreach ($files as $file) {
        if ($file->isFile() && $file->getExtension() === 'md') {
            $mdFiles[] = $file->getPathname();
        }
    }

    expect(count($mdFiles))->toBe(22);
});

test('features/_example_ directory contains required files', function () {
    $examplePath = __DIR__.'/../../stubs/features/_example_';

    expect(file_exists($examplePath.'/spec.md'))->toBeTrue();
    expect(file_exists($examplePath.'/plan.md'))->toBeTrue();
    expect(file_exists($examplePath.'/tasks.md'))->toBeTrue();
    expect(file_exists($examplePath.'/memory.md'))->toBeTrue();
    expect(file_exists($examplePath.'/clarifications.md'))->toBeTrue();
});

test('INSTALLTASKIFYCOMMAND has forceOverwrite property', function () {
    $command = new InstallTaskifyCommand;

    expect(property_exists($command, 'forceOverwrite'))->toBeTrue();
});

afterEach(function () {
    File::deleteDirectory(base_path('.ai'));
    File::deleteDirectory(base_path('features'));
    if (File::exists(base_path('PROJECT_CONTEXT.md'))) {
        File::delete(base_path('PROJECT_CONTEXT.md'));
    }
});

test('taskify:install creates the kit structure with --force', function () {
    $this->artisan('taskify:install', ['--force' => true])
        ->assertExitCode(Command::SUCCESS);

    expect(File::exists(base_path('.ai')))->toBeTrue();
    expect(File::exists(base_path('PROJECT_CONTEXT.md')))->toBeTrue();
    expect(File::exists(base_path('features/_example_')))->toBeTrue();
    expect(File::exists(base_path('.ai/rules/constitution.md')))->toBeTrue();
});

test('taskify:install publishes exactly 22 md files into .ai', function () {
    $this->artisan('taskify:install', ['--force' => true])
        ->assertExitCode(Command::SUCCESS);

    $count = 0;
    $iter = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator(base_path('.ai'), RecursiveDirectoryIterator::SKIP_DOTS)
    );
    foreach ($iter as $file) {
        if ($file->isFile() && $file->getExtension() === 'md') {
            $count++;
        }
    }
    expect($count)->toBe(22);
});
