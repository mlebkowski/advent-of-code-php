<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D18;

use App\Aoc\Challenge;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Ansi\Ansi;
use App\Realms\Cartography\Map;
use RuntimeException;

/**
 * @implements Solution<SettlersOfTheNorthPoleInput>
 * @see file://var/2018-18.txt
 * @see file://var/2018-18-1-sample.txt
 * @see file://var/2018-18-1-expected.txt
 * @see file://var/2018-18-2-sample.txt
 * @see file://var/2018-18-2-expected.txt
 */
final class SettlersOfTheNorthPole implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2018, 18);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): int
    {
        $project = ConstructionProject::ofMap($input->map);
        $day = 0;
        echo Ansi::clearScren(), Ansi::hideCursor();
        $iterations = [];
        $thousandsOfYears = 1_000_000_000;
        while (++$day) {
            $map = (string)$project->toMap($input->map->width);
            $index = array_search($map, $iterations, true);
            if (false !== $index) {
                $thousandsOfYears -= $index;
                $loopSize = count($iterations) - $index;
                $thousandsOfYears %= $loopSize;
                $map = $iterations[$thousandsOfYears + $index];
                return ConstructionProject::ofMap(Map::fromString($map))->resourceValue();
            }
            $iterations[] = $map;
            echo $project->toMap($input->map->width)
                ->apply(static fn (string $item) => match ($item) {
                    '|' => Ansi::green('|'),
                    default => $item,
                })
                ->withBoxDrawing(),
            "\n", Ansi::moveUp($input->map->height);
            $project = $project->step();
            if ($day === 10 && $challenge->isPartOne()) {
                return $project->resourceValue();
            }
        }

        throw new RuntimeException('This shouldn’t happen');
    }
}
