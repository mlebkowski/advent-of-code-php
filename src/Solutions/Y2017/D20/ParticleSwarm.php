<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D20;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use loophp\collection\Collection;

/**
 * @implements Solution<ParticleSwarmInput>
 * @see file://var/2017-20.txt
 * @see file://var/2017-20-1-sample.txt
 * @see file://var/2017-20-1-expected.txt
 * @see file://var/2017-20-2-sample.txt
 * @see file://var/2017-20-2-expected.txt
 */
final class ParticleSwarm implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 20);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        if ($challenge->isPartOne()) {
            return Collection::fromIterable($input->particles)
                ->sort(callback: Particle::lowestAcceleration(...))
                ->keys()
                ->first();
        }

        $progress = Progress::unknown();
        $particles = $input->particles;
        $i = 0;
        while ($i++ < 100) {
            $particles = Collection::fromIterable($particles)
                ->map(static fn (Particle $particle) => $particle->step())
                ->groupBy(static fn (Particle $particle) => (string)$particle->position)
                ->reject(static fn (array $clusters) => count($clusters) > 1)
                ->flatten()
                ->all();
            $progress->iterate(count($particles));
        }

        return count($particles);
    }
}
