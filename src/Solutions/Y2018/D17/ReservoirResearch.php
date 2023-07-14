<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D17;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Area;
use App\Realms\Cartography\LineSegment;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Orientation;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

/**
 * @implements Solution<ReservoirResearchInput>
 * @see file://var/2018-17.txt
 * @see file://var/2018-17-1-sample.txt
 * @see file://var/2018-17-1-expected.txt
 * @see file://var/2018-17-2-sample.txt
 * @see file://var/2018-17-2-expected.txt
 */
final class ReservoirResearch implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 17);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $points = Collection::fromIterable($input->lineSegments)
            ->flatMap(static fn (LineSegment $lineSegment) => $lineSegment->points);

        $area = Area::covering(...$points)
            ->extend(Orientation::West) // room for overflow left
            ->extend(Orientation::East) // room for overflow right
            ->extend(Orientation::North); // room for water spring

        $map = Map::ofArea($area, ' ')->overlayPoints(
            $points->map(static fn (Point $point) => [$point->offset($area->minCorner), '#']),
        );

        $start = Point::of(
            x: 500 - $area->minCorner->x,
            y: 0,
        );

        $water = FlowAnimation::animate($start, $map);
        return $challenge->isPartOne() ? $water->all : $water->retained;
    }
}
