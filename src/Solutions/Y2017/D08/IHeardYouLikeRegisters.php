<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D08;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<IHeardYouLikeRegistersInput>
 * @see file://var/2017-8.txt
 * @see file://var/2017-8-1-sample.txt
 * @see file://var/2017-8-1-expected.txt
 * @see file://var/2017-8-2-sample.txt
 * @see file://var/2017-8-2-expected.txt
 */
final class IHeardYouLikeRegisters implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 8);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        return null;
    }
}
