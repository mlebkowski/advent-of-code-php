<?php

declare(strict_types=1);

namespace App\Solutions\Y2018\D09;

use App\Aoc\Runner\InputParser;
use App\Lib\Type\Cast;

/** @implements InputParser<MarbleManiaInput> */
final class MarbleManiaInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match('/(\d+) players; last marble is worth (\d+) points/', $input, $matches);
        $values = array_map(Cast::toInt(...), array_slice($matches, 1));
        return new MarbleManiaInput(...$values);
    }
}
