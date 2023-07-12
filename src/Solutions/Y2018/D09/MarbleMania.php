<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D09;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RequiresMemoryLimit;
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
final class MarbleMania implements Solution, RequiresMemoryLimit
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 9);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $iterations = ($challenge->isPartOne() ? 1 : 100) * $input->lastMarble;
        $progress = Progress::ofExpectedIterations($iterations)
            ->reportInSteps(10_000)
            ->withMemoryUsage();
        $game = Game::of($input->players);
        return $game->play($iterations, $progress);
    }

    public function getRequiredMemoryLimit(): string
    {
        return '256M';
    }
}
