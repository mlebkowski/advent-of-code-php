<?php

declare(strict_types=1);

namespace App\Aoc\Discovery;

use loophp\collection\Collection;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use RegexIterator;

final class ImplementationsDiscovery
{
    private readonly Collection $classes;

    public function __construct(private readonly string $sourcesDir)
    {
        $existing = get_declared_classes();
        $this->rsearch($this->sourcesDir, '/.+\.php/')
            ->map(
                static fn (string $filePath) => require_once $filePath,
            )
            ->squash();

        $this->classes = Collection::fromIterable(get_declared_classes())
            ->diff($existing)
            ->map(static fn (string $className) => new ReflectionClass($className));
    }

    public function findImplementations(string $interface): array
    {
        return $this->classes
            ->filter(static fn (ReflectionClass $ref) => $ref->implementsInterface($interface))
            ->map(static fn (ReflectionClass $ref) => $ref->newInstance())
            ->all();
    }

    private function rsearch(string $folder, string $regPattern): Collection
    {
        // https://stackoverflow.com/questions/17160696/php-glob-scan-in-subfolders-for-a-file
        $dir = new RecursiveDirectoryIterator($folder);
        $ite = new RecursiveIteratorIterator($dir);
        $files = new RegexIterator($ite, $regPattern, RegexIterator::GET_MATCH);
        return Collection::fromIterable($files)->flatten();
    }

}
