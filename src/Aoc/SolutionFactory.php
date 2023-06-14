<?php

declare(strict_types=1);

namespace App\Aoc;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use RegexIterator;
use RuntimeException;

final readonly class SolutionFactory
{
    /** @var Solution[] */
    private iterable $solutions;

    public function __construct(string $sourcesDir)
    {
        $existing = get_declared_classes();
        collect($this->rsearch($sourcesDir, '/.+\.php/'))
            ->each(
                static fn (string $filePath) => require_once $filePath,
            );

        $this->solutions = collect(get_declared_classes())
            ->diff($existing)
            ->map(static fn (string $className) => new ReflectionClass($className))
            ->filter(static fn (ReflectionClass $ref) => $ref->implementsInterface(Solution::class))
            ->map(static fn (ReflectionClass $ref) => $ref->newInstance());
    }

    public function make(Challenge $challenge): Solution
    {
        $supports = static fn (Solution $solution) => collect($solution->challenges())->contains(
            static fn (Challenge $supports) => $supports->equals($challenge),
        );

        return collect($this->solutions)
            ->first(static fn (Solution $solution) => $supports($solution))
            ?? throw new RuntimeException(sprintf('No solution for %s', $challenge));
    }

    private function rsearch(string $folder, string $regPattern): iterable
    {
        // https://stackoverflow.com/questions/17160696/php-glob-scan-in-subfolders-for-a-file
        $dir = new RecursiveDirectoryIterator($folder);
        $ite = new RecursiveIteratorIterator($dir);
        $files = new RegexIterator($ite, $regPattern, RegexIterator::GET_MATCH);
        return collect($files)->flatten();
    }

}
