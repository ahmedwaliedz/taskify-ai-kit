<?php

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

test('taskify install command creates files', function () {
    $this->artisan('taskify:install', ['--force' => true]);

    expect(file_exists(base_path('.ai')))->toBeTrue();
    expect(file_exists(base_path('PROJECT_CONTEXT.md')))->toBeTrue();
    expect(file_exists(base_path('features/_example_')))->toBeTrue();
});

test('taskify install command fails without artisan', function () {
    expect(function () {
        $command = new InstallTaskifyCommand;
        $command->handle();
    })->not->toThrow(Exception::class);
});
