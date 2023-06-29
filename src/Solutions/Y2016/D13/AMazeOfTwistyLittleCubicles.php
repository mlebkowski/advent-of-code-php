<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D13;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Path;
use App\Realms\Cartography\PathFinding;
use App\Realms\Cartography\Point;
use loophp\collection\Collection;

/** @implements Solution<AMazeOfTwistyLittleCubiclesInput> */
final class AMazeOfTwistyLittleCubicles implements Solution
{
    private const MaxMoves = 50;

    public function challenges(): iterable
    {
        return Challenge::bothParts(2016, 13);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $width = $runMode->isSample() ? 10 : self::MaxMoves;
        $height = $runMode->isSample() ? 7 : 42;
        $target = $runMode->isSample() ? Point::of(7, 4) : Point::of(31, 39);
        $startingPoint = Point::of(1, 1);

        $builder = CoordinateBuilder::of($input->designersFavouriteNumber, $width);
        $maze = Maze::ofMagicNumber($builder, width: $width, height: $height);

        $pathFinding = PathFinding::of($maze->points, $maze->width);

        $path = $pathFinding->getPath($startingPoint, $target);

        if ($challenge->isPartOne()) {
            $map = $maze->toMap()->overlay($path->toMap(), $path->area()->minCorner);

            echo "\n", $map, "\n\n";

            return $path->steps();
        }

        return Collection::range(0, $width * $height)
            ->map(static fn (float $idx) => $pathFinding->tryGetPath($startingPoint, Point::of(
                x: (int)$idx % $width,
                y: (int)floor($idx / $width),
            )))
            ->reject(static fn (?Path $path) => ($path?->steps() ?? PHP_INT_MAX) > self::MaxMoves)
            ->apply(static function (Path $path) use ($maze) {
                $map = $maze->toMap()->overlay($path->toMap(), $path->area()->minCorner);

                echo "\n", $map, "\n\n";
                usleep(100_000);
            })
            ->count();
    }
}
