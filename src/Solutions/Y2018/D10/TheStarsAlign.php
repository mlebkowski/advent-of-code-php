<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D10;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Ansi\DisplayMapInIterations;

/**
 * @implements Solution<TheStarsAlignInput>
 * @see file://var/2018-10.txt
 * @see file://var/2018-10-1-sample.txt
 * @see file://var/2018-10-1-expected.txt
 * @see file://var/2018-10-2-sample.txt
 * @see file://var/2018-10-2-expected.txt
 */
final class TheStarsAlign implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 10);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $sky = Sky::ofStars(...$input->stars);
        $animate = $sky->animate();

        echo "\n\n";
        DisplayMapInIterations::display($animate, 50_000);
        echo "\n";
        echo $animate->getReturn()->photo, "\n\n";
        return $animate->getReturn()->seconds;
    }
}
