<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D08;

use App\Aoc\Runner\InputParser;
use App\Lib\Type\Cast;

/** @implements InputParser<MemoryManeuverInput> */
final class MemoryManeuverInputParser implements InputParser
{
    public function parse(string $input): object
    {
        return new MemoryManeuverInput(
            array_map(Cast::toInt(...), preg_split('/\s+/', trim($input))),
        );
    }
}
