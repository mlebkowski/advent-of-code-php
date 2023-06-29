<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D15;

use App\Aoc\Challenge;
use App\Aoc\Progress\Progress;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<TimingIsEverythingInput>
 * @see file://var/2016-15.txt
 * @see file://var/2016-15-1-sample.txt
 * @see file://var/2016-15-1-expected.txt
 * @see file://var/2016-15-2-sample.txt
 * @see file://var/2016-15-2-expected.txt
 */
final class TimingIsEverything implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 15);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $progress = Progress::unknown()->reportInSteps(10_001);
        $discs = $input->discs;
        if ($challenge->isPartTwo()) {
            $discs[] = Disc::of(11, count($discs) + 1);
        }
        $sculpture = KineticSculpture::of(...$discs);

        while (true) {
            $progress->step();
            $sculpture = $sculpture->advance();
            $progress->report($sculpture);
            if ($sculpture->fallsInPlace()) {
                return $sculpture->time;
            }
        }
    }
}
