<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D20;

use App\Aoc\Challenge;
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
        return Collection::fromIterable($input->particles)
            ->sort(callback: Particle::lowestAcceleration(...))
            ->keys()
            ->first();
    }
}
