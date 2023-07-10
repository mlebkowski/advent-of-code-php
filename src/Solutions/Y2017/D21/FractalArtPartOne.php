<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D21;

use App\Aoc\Challenge;
use App\Aoc\Part;
use App\Aoc\Runner\RunMode;
use App\Aoc\Solution;
use App\Realms\Cartography\Map;

/**
 * @implements Solution<FractalArtInput>
 * @see file://var/2017-21.txt
 * @see file://var/2017-21-1-sample.txt
 * @see file://var/2017-21-1-expected.txt
 * @see file://var/2017-21-2-sample.txt
 * @see file://var/2017-21-2-expected.txt
 */
final class FractalArtPartOne implements Solution
{
    public function challenges(): iterable
    {
        yield Challenge::of(2017, 21, Part::One);
    }

    public function solve(Challenge $challenge, mixed $input, RunMode $runMode): mixed
    {
        $iterations = $runMode->isSample() ? 2 : 5;

        $start = Map::fromString(
            <<<MAP
            .#.
            ..#
            ###
            MAP
        );

        echo "\n\n", $start->withBoxDrawing(), "\n";

        $generator = ArtGenerator::of(...$input->rules)->enchance($start);
        $first = true;
        while ($iterations-- > 0) {
            $first || $generator->next();
            $first = false;
            echo "\n\n", $generator->current()->withBoxDrawing(), "\n";
        }
        $target = $generator->current();

        return substr_count((string)$target, '#');
    }
}
