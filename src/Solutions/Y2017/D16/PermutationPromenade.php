<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D16;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Solutions\Y2017\D16\DanceMoves\DanceMove;

/**
 * @implements Solution<PermutationPromenadeInput>
 * @see file://var/2017-16.txt
 * @see file://var/2017-16-1-sample.txt
 * @see file://var/2017-16-1-expected.txt
 * @see file://var/2017-16-2-sample.txt
 * @see file://var/2017-16-2-expected.txt
 */
final class PermutationPromenade implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 16);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $programs = $runMode->isSample() ? range('a', 'e') : range('a', 'p');
        $result = array_reduce(
            $input->moves,
            static fn (array $programs, DanceMove $move) => $move->apply($programs),
            $programs,
        );
        return implode('', $result);
    }
}
