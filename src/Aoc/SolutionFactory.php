<?php

declare(strict_types=1);

namespace App\Aoc;

use App\Aoc\Discovery\ImplementationsDiscovery;
use loophp\collection\Collection;
use RuntimeException;

final readonly class SolutionFactory
{
    public function __construct(private ImplementationsDiscovery $implementations)
    {
    }

    public function make(Challenge $challenge): Solution
    {
        return $this->getSolutions()->find(callbacks: $challenge->isSolvedBy(...))
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

    public function getSolutions(): Collection
    {
        return $this->implementations->findImplementations(Solution::class);
    }
}
