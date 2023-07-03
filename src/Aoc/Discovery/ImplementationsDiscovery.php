<?php

declare(strict_types=1);

namespace App\Aoc\Discovery;

use loophp\collection\Collection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use SplFileInfo;

final class ImplementationsDiscovery
{
    private readonly Collection $classes;

    public function __construct(private readonly string $sourcesDir)
    {
        $existing = get_declared_classes();
        $this->rsearch($this->sourcesDir)
            ->filter(static fn (SplFileInfo $fileInfo) => 'php' === $fileInfo->getExtension())
            ->filter(static fn (SplFileInfo $fileInfo) => ctype_upper($fileInfo->getFilename()[0]))
            ->apply(static fn (SplFileInfo $filePath) => require_once $filePath)
            ->squash();

        $this->classes = Collection::fromIterable(get_declared_classes())
            ->diff($existing)
            ->map(static fn (string $className) => new ReflectionClass($className));
    }

    public function findImplementations(string $interface): Collection
    {
        return $this->classes
            ->filter(static fn (ReflectionClass $ref) => $ref->implementsInterface($interface))
            ->map(static fn (ReflectionClass $ref) => $ref->newInstance());
    }

    private function rsearch(string $folder): Collection
    {
        // https://stackoverflow.com/questions/17160696/php-glob-scan-in-subfolders-for-a-file
        $dir = new RecursiveDirectoryIterator($folder);
        $files = new RecursiveIteratorIterator($dir);
        return Collection::fromIterable($files)->flatten();
    }
}
