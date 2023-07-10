<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D22;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Point;

/**
 * @implements Solution<SporificaVirusInput>
 * @see file://var/2017-22.txt
 * @see file://var/2017-22-1-sample.txt
 * @see file://var/2017-22-1-expected.txt
 * @see file://var/2017-22-2-sample.txt
 * @see file://var/2017-22-2-expected.txt
 */
final class SporificaVirus implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 22);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $cluster = Cluster::ofMap($input->infectionMap);
        $startingPoint = Point::of(
            x: (int)floor($input->infectionMap->width / 2),
            y: (int)floor($input->infectionMap->height / 2),
        );
        $carrier = VirusCarrier::ofCluster($cluster, $startingPoint);
        $iterations = 10_000;
        while (--$iterations > 0) {
            $carrier->burst();
        }
        return $cluster->infectionCount();
    }
}
