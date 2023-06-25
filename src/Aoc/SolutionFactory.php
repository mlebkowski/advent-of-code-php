<?php

declare(strict_types=1);

namespace App\Aoc;

use App\Aoc\Discovery\ImplementationsDiscovery;
use RuntimeException;

final readonly class SolutionFactory
{
    public function __construct(private ImplementationsDiscovery $implementations)
    {
    }

    public function make(Challenge $challenge): Solution
    {
        $supports = static fn (Solution $solution) => collect($solution->challenges())->contains(
            static fn (Challenge $supports) => $supports->equals($challenge),
        );

        return $this->getSolutions()
            ->first(static fn (Solution $solution) => $supports($solution))
            ?? throw new RuntimeException(sprintf('No solution for %s', $challenge));
    }

    public function mostRecentChallenge(): Challenge
    {
        return $this->getSolutions()
            ->flatMap(static fn (Solution $solution) => $solution->challenges())
            ->sort(
                callback: Challenge::mostRecent(...),
            )
            ->last()
            ?? throw new RuntimeException('No implementations yet');
    }

    public function getSolutions(): \Illuminate\Support\Collection
    {
        return collect($this->implementations->findImplementations(Solution::class));
    }
}
