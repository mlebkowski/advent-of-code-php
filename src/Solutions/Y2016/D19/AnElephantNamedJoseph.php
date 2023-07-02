<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D19;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<AnElephantNamedJosephInput>
 * @see file://var/2016-19.txt
 * @see file://var/2016-19-1-sample.txt
 * @see file://var/2016-19-1-expected.txt
 * @see file://var/2016-19-2-sample.txt
 * @see file://var/2016-19-2-expected.txt
 */
final class AnElephantNamedJoseph implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 19);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $clearMostSignificantBit = static function (float $n): int {
            assert($n < 2 ** 32);
            $mask = $n;
            $mask |= $mask >> 1;
            $mask |= $mask >> 2;
            $mask |= $mask >> 4;
            $mask |= $mask >> 16;

            $mask >>= 1;
            return $n & $mask;
        };

        return 1 + ($clearMostSignificantBit($input->numberOfElves) << 1);
    }
}
