<?php

declare(strict_types=1);

namespace App\Solutions\Y2015\D25;

use App\Aoc\Runner\InputParser;

/** @implements InputParser<LetItSnowInput> */
final class LetItSnowInputParser implements InputParser
{
    public function parse(string $input): object
    {
        preg_match('/Enter the code at row (?P<row>\d+), column (?P<column>\d+)/', $input, $m);
        return new LetItSnowInput((int)$m['row'], (int)$m['column']);
    }
}
