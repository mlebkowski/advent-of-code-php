<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D18;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<LikeARougeInput>
 * @see file://var/2016-18.txt
 * @see file://var/2016-18-1-sample.txt
 * @see file://var/2016-18-1-expected.txt
 * @see file://var/2016-18-2-sample.txt
 * @see file://var/2016-18-2-expected.txt
 */
final class LikeARouge implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 18);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $size = $challenge->isPartOne() ? 40 : 400_000;
        $progress = Progress::ofExpectedIterations($size)->reportInSteps(1_000);
        return Room::calculateSafeTilesCount($input->row, $size, $progress);
    }
}
