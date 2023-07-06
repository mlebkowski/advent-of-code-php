<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D12;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<DigitalPlumberInput>
 * @see file://var/2017-12.txt
 * @see file://var/2017-12-1-sample.txt
 * @see file://var/2017-12-1-expected.txt
 * @see file://var/2017-12-2-sample.txt
 * @see file://var/2017-12-2-expected.txt
 */
final class DigitalPlumber implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 12);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $system = PlumbingSystem::ofPipes(...$input->pipes);

        if ($challenge->isPartOne()) {
            return $system->connectedTo(0);
        }

        return $system->numberOfGroups();
    }
}
