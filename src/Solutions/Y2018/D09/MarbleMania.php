<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D09;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<MarbleManiaInput>
 * @see file://var/2018-9.txt
 * @see file://var/2018-9-1-sample.txt
 * @see file://var/2018-9-1-expected.txt
 * @see file://var/2018-9-2-sample.txt
 * @see file://var/2018-9-2-expected.txt
 */
final class MarbleMania implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 9);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $game = Game::of($input->players);
        return $game->play($input->lastMarble);
    }
}
