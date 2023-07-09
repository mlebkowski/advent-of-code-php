<?php

declare(strict_types=1);

namespace App\Solutions\Y2017\D19;

use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Map;

/** @implements InputParser<ASeriesOfTubesInput> */
final class ASeriesOfTubesInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new ASeriesOfTubesInput(Map::fromString(substr($input, 0, -2)));
    }
}
