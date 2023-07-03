<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D25;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<ClockSignalInput>
 * @see file://var/2016-25.txt
 * @see file://var/2016-25-1-sample.txt
 * @see file://var/2016-25-1-expected.txt
 * @see file://var/2016-25-2-sample.txt
 * @see file://var/2016-25-2-expected.txt
 */
final class ClockSignal implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 25);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return SeedFinder::find(Progress::unknown(), ...$input->instructions);
    }
}
