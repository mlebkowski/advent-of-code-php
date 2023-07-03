<?php

declare(strict_types=1);

namespace App\Solutions\Y2016\D24;

use App\Aoc\Runner\InputParser;
use App\Realms\Cartography\Map;

/** @implements InputParser<AirDuctSpelunkingInput> */
final class AirDuctSpelunkingInputParser implements InputParser
{
    public function parse(string $input): object
    {
        $points = str_split(str_replace("\n", "", $input));
        $width = strpos($input, "\n");
        return new AirDuctSpelunkingInput(Map::ofPoints($points, $width));
    }
}
