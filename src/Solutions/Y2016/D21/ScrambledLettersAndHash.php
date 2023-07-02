<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D21;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<ScrambledLettersAndHashInput>
 * @see file://var/2016-21.txt
 * @see file://var/2016-21-1-sample.txt
 * @see file://var/2016-21-1-expected.txt
 * @see file://var/2016-21-2-sample.txt
 * @see file://var/2016-21-2-expected.txt
 */
final class ScrambledLettersAndHash implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 21);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): string
    {
        $scrambler = Scrambler::of(...$input->operations);

        if ($challenge->isPartOne()) {
            return $scrambler->scramble('abcdefgh');
        }

        return $scrambler->reverse('fbgdceah');
    }
}
