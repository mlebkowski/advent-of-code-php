<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D07;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<TheSumOfItsPartsInput>
 * @see file://var/2018-7.txt
 * @see file://var/2018-7-1-sample.txt
 * @see file://var/2018-7-1-expected.txt
 * @see file://var/2018-7-2-sample.txt
 * @see file://var/2018-7-2-expected.txt
 */
final class TheSumOfItsParts implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 7);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $steps = Steps::ofRules(...$input->rules);
        return implode("", iterator_to_array($steps->ordered()));
    }
}
