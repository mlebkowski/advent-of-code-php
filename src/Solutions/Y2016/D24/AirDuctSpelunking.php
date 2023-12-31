<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;

/**
 * @implements Solution<AirDuctSpelunkingInput>
 * @see file://var/2016-24.txt
 * @see file://var/2016-24-1-sample.txt
 * @see file://var/2016-24-1-expected.txt
 * @see file://var/2016-24-2-sample.txt
 * @see file://var/2016-24-2-expected.txt
 */
final class AirDuctSpelunking implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 24);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $map = $input->map;

        $pois = PointsOfInterest::fromMap($map);
        $pathFinding = $map->toPathFinding('#');

        $start = array_shift($pois);
        $goBackToStart = $challenge->isPartTwo();
        $route = FastestRouteFinder::ofPoints($pathFinding, $start, $goBackToStart, ...$pois)
            ->findFastestRoute();

        $map = $map->overlayPath($route);

        echo "\n" . $map->withBoxDrawing(), "\n\n";
        return $route->steps();
    }
}
