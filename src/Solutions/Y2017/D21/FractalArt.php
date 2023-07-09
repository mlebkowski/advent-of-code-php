<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D21;

use App\Aoc\Challenge;
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
final class FractalArt implements Solution
{
    public function challenges(): iterable
    {
        return Challenge::bothParts(2017, 21);
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
        $generator = ArtGenerator::of(...$input->rules)->enchance($start);
        while ($iterations-- > 1) {
            $generator->next();
            echo "\n\n", $generator->current(), "\n";
        }
        $target = $generator->current();

        return substr_count((string)$target, '#');
    }
}
