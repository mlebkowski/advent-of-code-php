<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D21;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Map;
use App\Solutions\Y2017\D21\Simulator\ArtGeneratorSimulator;

/**
 * @implements Solution<FractalArtInput>
 * @see file://var/2017-21.txt
 * @see file://var/2017-21-1-sample.txt
 * @see file://var/2017-21-1-expected.txt
 * @see file://var/2017-21-2-sample.txt
 * @see file://var/2017-21-2-expected.txt
 */
final class FractalArtPartTwo implements Solution
{
    public function challenges(): iterable
    {
        yield Challenge::of(2017, 21, Part::Two);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $iterations = 18;

        $start = Map::fromString(
            <<<MAP
            .#.
            ..#
            ###
            MAP
        );

        $simulator = ArtGeneratorSimulator::of($start, ...$input->rules);
        return $simulator->afterIterations($iterations);
    }
}
