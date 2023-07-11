<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D06;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Lib\Generators\LoopedSequence;
use App\Realms\Cartography\Area;
use App\Realms\Cartography\Map;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

/**
 * @implements Solution<ChronalCoordinatesInput>
 * @see file://var/2018-6.txt
 * @see file://var/2018-6-1-sample.txt
 * @see file://var/2018-6-1-expected.txt
 * @see file://var/2018-6-2-sample.txt
 * @see file://var/2018-6-2-expected.txt
 */
final class ChronalCoordinates implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 6);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $letters = range('A', 'Z');
        $colors = range(1, 6);
        $colors = Collection::fromIterable(LoopedSequence::of($letters))
            ->zip(LoopedSequence::of($colors))
            ->unpack()
            ->map(static fn (int $color, string $letter) => sprintf("\033[0;4%dm%s\033[0m", $color, $letter))
            ->limit(count($input->coordinates))
            ->all();

        $area = Area::covering(...$input->coordinates);
        $points = Collection::fromIterable($input->coordinates)
            ->map(static fn (Point $point, int $idx) => [$point, $colors[$idx]])
            ->unpack();

        $map = Map::empty(
            width: $area->width() + $area->minCorner->x + 1,
            height: $area->height() + $area->minCorner->y + 1,
            fill: '.',
        )->overlayPoints($points->pack());

        if ($challenge->isPartOne()) {
            $counter = ClosestCounter::of($points);
            $map = $map->apply($counter->getClosest(...))->cutOut($area);

            echo "\n\n", $map, "\n";

            $inner = Area::covering(
                Point::of(x: 1, y: 1),
                Point::of(x: $map->width - 2, y: $map->height - 2),
            );

            return $map->withCoordinates()
                ->reject(static fn (string $value) => '.' === $value)
                ->pack()
                ->groupBy(static fn (array $pair) => end($pair))
                ->filter(static fn (iterable $points) => $inner->contains(
                    Area::covering(
                        ...
                        Collection::fromIterable($points)
                            ->unpack()
                            ->keys()
                            ->all(),
                    ),
                ))
                ->map(static fn (array $points) => count($points) + 1)
                ->sort()
                ->last();
        }

        $distance = $runMode->isSample() ? 32 : 10000;
        $calculator = TotalDistanceCalculator::of($distance, ...$points->keys()->all());
        $isWithinTotalDistance = $calculator->isWithinTotalDistance(...);
        $map = $map->apply(
            static fn (string $value, Point $point) => $isWithinTotalDistance($point)
                ? sprintf("\033[0m\033[0;43m%s\033[0m", $value)
                : $value,
        );

        echo "\n\n", $map, "\n";
        return $map->withCoordinates()
            ->filter(static fn (string $value) => str_starts_with($value, "\033[0m"))
            ->count();
    }
}
